<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            size: A4 landscape;
            margin: 10px;
        }
    
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 10px;
        }
    
        .heading-section {
            text-align: center;
            position: relative;
        }
    
        .week-range {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 10px;
            color: gray;
        }
    
        .heading-section img {
            height: 40px;
            width: auto;
            display: inline-block;
        }
    
        h4 {
            font-size: 16px;
            margin-bottom: 5px;
            text-align: center;
            color: gray;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
            table-layout: fixed;
        }
    
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 4px;
            font-size: 10px;
            vertical-align: middle;
            word-wrap: break-word;
        }
    
        th {
            background-color: #f4f4f4;
            font-weight: bold;
            font-size: 12px;
        }
    
        .class-title {
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 3px;
        }

        .club-title {
            font-weight: bold;
            color: #333;
            text-align: left;
            margin-bottom: 3px;
            margin-top: 10px;
        }
    
        .table-wrap img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
    
        .sub-title {
            font-size: 8px;
            color: gray;
            margin-top: 0px;
            text-align: left;
        }
    
        .line {
            color: gray;
            margin-bottom: 3px;
            padding-bottom: 3px;
            border-bottom: 1px solid #ddd;
        }
    
        .time-text {
            color: #ff6b6b;
            font-size: 8px;
            text-align: center;
        }
    
        footer .footer {
            text-align: center;
            font-size: 8px;
            margin-top: 5px;
            padding-top: 5px;
            border-top: 1px solid #ddd;
            color: gray;
        }
    
        .content {
            display: flex;
            align-items: flex-start;
        }
    
        .content img {
            margin-right: 5px;
            flex-shrink: 0;
        }
    
        .content-text {
            display: inline-block;
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
            flex-grow: 1;
            word-break: break-word;
        }
    </style>
</head>
<body>
    <section class="ftco-section">
        <div class="container">
            <!-- Logo Section -->
            <div class="heading-section">
                <!-- Week Range -->
                @if(isset($startOfWeek) && isset($endOfWeek))
                    <div class="week-range">
                        Semaine: {{ $startOfWeek->format('d/m/Y') }} - {{ $endOfWeek->format('d/m/Y') }}
                    </div>
                @endif

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
                                                <img src="data:image/{{ pathinfo($path, PATHINFO_EXTENSION) }};base64,{{ $lessonImageBase64 }}" alt="Lesson Logo" class="lesson-logo">
                                            @else
                                                <img src="{{ asset('assets/images/no-image.png') }}" alt="Default Lesson Picture" class="lesson-logo">
                                            @endif
                                            
                                            <!-- Text Content -->
                                            <div class="content-text">
                                                <!-- Coach Name -->
                                                <div class="club-title">
                                                    {{ optional($dailyCourses->coach)->name ?? 'No Coach' }}
                                                </div>
                                                
                                                <!-- Lesson and Room -->
                                                <div class="sub-title">
                                                    {{ optional($dailyCourses->lesson)->name ?? 'No Lesson' }} 
                                                </div>
                                                <div class="sub-title">
                                                    {{ optional($dailyCourses->room)->name ?? 'No Room' }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Time -->
                                        <div class="line"></div>
                                        <div class="time-text">
                                            {{ \Carbon\Carbon::parse($dailyCourses->startTime)->format('g:i a') }} - 
                                            {{ \Carbon\Carbon::parse($dailyCourses->endTime)->format('g:i a') }}
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
