<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            size: A4 landscape;
            margin: 20px;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .heading-section {
            text-align: center;
            position: relative;
        }

        .week-range {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 12px;
            color: gray;
        }

        .heading-section img {
            text-align: center;
            height: 50px;
            width: auto;
            display: inline-block;
        }

        h4 {
            font-size: 18px;
            margin-bottom: 0px;
            text-align: center;
            color: gray;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px; 
            font-size: 12px; 
            vertical-align: middle;
            word-wrap: break-word;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
            font-size: 14px;
        }

        .class-title {
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 5px;
        }

        .table-wrap img {
            width: 30px; 
            height: 30px;
            border-radius: 50%;
            margin-bottom: 5px;
        }

        .sub-title {
            font-size: 10px; 
            color: gray;
            margin-top: 0px;
        }

        .line {
            color: gray;
            margin-bottom: 5px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }

        .time-text {
            color: #ff6b6b;
            font-size: 10px;
        }

        footer .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            color: gray;
        }
    </style>
</head>
<body>
    <section class="ftco-section">
        <div class="container">
            <!-- Logo Section -->
            <div class="heading-section">
                <!-- Week Range -->
                @php
                    $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
                    $endOfWeek = \Carbon\Carbon::now()->endOfWeek();
                @endphp
                <div class="week-range">
                    Semaine: {{ $startOfWeek->format('d/m/Y') }} - {{ $endOfWeek->format('d/m/Y') }}
                </div>

                <!-- Logo -->
                @php
                    $path = public_path('assets/images/logo.png');
                    $logoData = '';
                    if (file_exists($path)) {
                        $logoData = base64_encode(file_get_contents($path));
                    }
                @endphp

                @if($logoData)
                    <img src="data:image/png;base64,{{ $logoData }}" alt="Logo">
                @else
                    <p>Logo not available</p>
                @endif
            </div>

            <!-- Table Title -->
            <h4>Programme des cours</h4>

            <!-- Table Section -->
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Lundi</th>
                            <th>Mardi</th>
                            <th>Mercredi</th>
                            <th>Jeudi</th>
                            <th>Vendredi</th>
                            <th>Samedi</th>
                            <th>Dimanche</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $groupedCourses = $courses->groupBy(function ($course) {
                                return \Carbon\Carbon::parse($course->startTime)->format('l');
                            });

                            $maxRows = max($groupedCourses->max(fn($dayCourses) => $dayCourses->count()), 1);
                        @endphp

                        @for ($row = 0; $row < $maxRows; $row++)
                        <tr>
                            @for ($day = 1; $day <= 7; $day++) 
                                <td>
                                    @php
                                        $dayName = \Carbon\Carbon::now()->startOfWeek()->addDays($day - 1)->format('l'); 
                                        $dailyCourses = $courses->filter(function($course) use ($dayName) {
                                            return \Carbon\Carbon::parse($course->startTime)->format('l') === $dayName;
                                        })->skip($row)->first();
                                    @endphp
                                    @if ($dailyCourses)
                                        @php
                                            $lessonMedia = $dailyCourses->lesson ? $dailyCourses->lesson->getFirstMedia('lessons_logo') : null;
                                            $lessonImageBase64 = '';
                                                  
                                            if ($lessonMedia) {
                                                $path = storage_path('app/public/' . $lessonMedia->id . '/' . $lessonMedia->file_name);
                                                if (file_exists($path)) {
                                                    $lessonImageBase64 = base64_encode(file_get_contents($path));
                                                }
                                            }
                                        @endphp
                                        @if (!$hideClub)
                                        <div class="class-title">
                                                {{ optional($dailyCourses->club)->name ?? 'No Club' }}
                                        </div>
                                        <div class="line"></div>
                                        @endif
                                        <div class="content">
                                            <!-- Image -->
                                            @if($lessonImageBase64)
                                                <img src="data:image/{{ pathinfo($path, PATHINFO_EXTENSION) }};base64,{{ $lessonImageBase64 }}" alt="Lesson Logo">
                                            @else
                                                <img src="{{ asset('assets/images/no-image.png') }}" alt="Default Lesson Picture">
                                            @endif
                                
                                            <!-- Text Content -->
                                            <div class="content-text">
                                                <!-- Coach -->
                                                <div class="class-title">
                                                    {{ optional($dailyCourses->coach)->name ?? 'No Coach' }}
                                                </div>
                                
                                                <!-- Lesson and Room -->
                                                <div class="sub-title">
                                                    {{ optional($dailyCourses->lesson)->name ?? 'No Lesson' }} 
                                                    | 
                                                    {{ optional($dailyCourses->room)->name ?? 'No Room' }}
                                                </div>
                                
                                                <!-- Divider Line -->
                                                <div class="line"></div>
                                
                                                <!-- Time -->
                                                <div class="time-text">
                                                    {{ \Carbon\Carbon::parse($dailyCourses->startTime)->format('g:i a') }} - 
                                                    {{ \Carbon\Carbon::parse($dailyCourses->endTime)->format('g:i a') }}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div>-</div>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
