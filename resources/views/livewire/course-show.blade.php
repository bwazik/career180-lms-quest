<div>
    <!-- Course Header -->
    <div class="relative bg-gradient-to-br from-slate-950 via-indigo-950 to-violet-950 overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-32 -right-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-violet-600/15 rounded-full blur-3xl animate-float-delay">
            </div>
            <div class="absolute inset-0 opacity-[0.03]"
                style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23fff&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">
            <div class="lg:w-2/3">
                <!-- Breadcrumb -->
                <nav class="flex mb-8" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li>
                            <a href="/" wire:navigate
                                class="inline-flex items-center text-indigo-300 hover:text-white transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                All Courses
                            </a>
                        </li>
                        <svg class="h-4 w-4 text-indigo-500/60" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <li class="font-semibold text-white truncate max-w-[250px]">{{ $course->title }}</li>
                    </ol>
                </nav>

                <h1
                    class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight mb-6 leading-tight animate-fade-in-up">
                    {{ $course->title }}
                </h1>

                <p class="text-lg text-indigo-200/80 max-w-3xl leading-relaxed mb-8 animate-fade-in-up-delay">
                    {{ Str::limit($course->description, 200) }}
                </p>

                <div class="flex flex-wrap gap-3 items-center animate-fade-in-up-delay-2">
                    <span
                        class="inline-flex items-center px-4 py-1.5 rounded-xl text-sm font-bold bg-white/10 text-white backdrop-blur-sm border border-white/10 shadow-lg">
                        <svg class="w-4 h-4 mr-2 text-indigo-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        {{ $course->level->name }}
                    </span>
                    <span class="inline-flex items-center text-indigo-300/80 text-sm font-medium">
                        <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Last updated {{ $course->updated_at->format('M Y') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Bottom fade into content -->
        <div
            class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-slate-50 dark:from-slate-950 to-transparent">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">
            <!-- Left Side: Content & Lessons -->
            <div class="lg:col-span-2 space-y-10">
                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="p-4 flex items-center bg-emerald-50 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 rounded-2xl border border-emerald-200 dark:border-emerald-700/50 shadow-sm shadow-emerald-500/5">
                        <div
                            class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-800/50 rounded-xl flex items-center justify-center mr-4">
                            <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="font-semibold text-sm">{{ session('message') }}</p>
                    </div>
                @endif

                <!-- About Section -->
                <section
                    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">About this course</h2>
                    </div>
                    <div
                        class="prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed">
                        {!! nl2br(e($course->description)) !!}
                    </div>
                </section>

                <!-- Course Content / Lessons -->
                <section
                    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between p-8 pb-0">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-violet-50 dark:bg-violet-500/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-violet-600 dark:text-violet-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-900 dark:text-white">Course Content</h2>
                        </div>
                        <span
                            class="text-xs font-semibold text-slate-400 bg-slate-50 dark:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-100 dark:border-slate-700">{{ $course->lessons->count() }}
                            Lessons &bull; {{ round($course->lessons->sum('duration_seconds') / 60) }} min</span>
                    </div>

                    <div x-data="{ activeLesson: null }" class="mt-6 divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($course->lessons as $index => $lesson)
                            <div class="group">
                                <button
                                    @click="activeLesson = (activeLesson === {{ $lesson->id }} ? null : {{ $lesson->id }})"
                                    class="w-full text-left px-8 py-5 flex items-center justify-between hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors duration-200 focus:outline-none">
                                    <div class="flex items-center space-x-4">
                                        @php
                                            $canAccess = $isEnrolled || $lesson->is_free_preview;
                                            $isDone = in_array($lesson->id, $completedLessonIds);
                                        @endphp

                                        <div
                                            class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-xl
                                                {{ $isDone
                                                    ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 dark:text-emerald-400'
                                                    : ($canAccess
                                                        ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 group-hover:bg-indigo-100 dark:group-hover:bg-indigo-500/20'
                                                        : 'bg-slate-100 dark:bg-slate-800 text-slate-400') }}
                                                transition-colors duration-200">
                                            @if ($isDone)
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @elseif ($canAccess)
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-semibold text-slate-800 dark:text-slate-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-200">{{ $lesson->title }}</span>
                                            <div class="flex items-center mt-1 gap-2">
                                                <span class="text-xs text-slate-400 flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ floor($lesson->duration_seconds / 60) }}:{{ str_pad($lesson->duration_seconds % 60, 2, '0', STR_PAD_LEFT) }}
                                                </span>
                                                @if ($lesson->is_free_preview && !$isEnrolled)
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-700/50">
                                                        <svg class="w-2.5 h-2.5 mr-0.5" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Free Preview
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <svg :class="{ 'rotate-180': activeLesson === {{ $lesson->id }} }"
                                        class="w-5 h-5 text-slate-300 dark:text-slate-600 transform transition-transform duration-300 flex-shrink-0"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="activeLesson === {{ $lesson->id }}" x-collapse x-cloak>
                                    <div class="px-8 pb-6 pt-1 pl-[5.5rem]">
                                        @if ($canAccess)
                                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Ready to watch?
                                                Dive in and start
                                                your learning journey.</p>
                                            <a href="/courses/{{ $course->slug }}/lessons/{{ $lesson->id }}"
                                                wire:navigate
                                                class="inline-flex items-center px-5 py-2.5 text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-500/20 transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0">
                                                Watch Lesson
                                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        @else
                                            <div
                                                class="bg-slate-50 dark:bg-slate-800 rounded-xl p-4 flex items-center border border-slate-100 dark:border-slate-700">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-slate-200/70 dark:bg-slate-700 flex items-center justify-center mr-3 flex-shrink-0">
                                                    <svg class="h-4 w-4 text-slate-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                </div>
                                                <p class="text-sm text-slate-500 dark:text-slate-400">This lesson is
                                                    locked. <button wire:click="enroll"
                                                        class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Enroll
                                                        in the
                                                        course</button> to unlock full access.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-16 text-center">
                                <div
                                    class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-slate-300 dark:text-slate-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <p class="font-semibold text-slate-500 dark:text-slate-400">No lessons available yet
                                </p>
                                <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Check back soon — content is
                                    on the way.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Right Side: Sticky Enrollment Card -->
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div
                        class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-black/30 border border-slate-200/80 dark:border-slate-700/80 overflow-hidden glow-ring transition-all duration-500">
                        <!-- Course Image -->
                        <div
                            class="aspect-[4/3] relative overflow-hidden bg-gradient-to-br from-slate-100 via-indigo-50 to-slate-100 dark:from-slate-800 dark:via-slate-700 dark:to-slate-800">
                            @if ($course->image)
                                <img src="{{ $course->image->url }}" alt="{{ $course->title }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-indigo-100 via-violet-50 to-indigo-100 dark:from-indigo-900/30 dark:via-violet-900/20 dark:to-indigo-900/30 flex items-center justify-center">
                                    <div class="relative">
                                        <div
                                            class="absolute -inset-4 bg-indigo-200/50 dark:bg-indigo-500/20 rounded-full blur-xl">
                                        </div>
                                        <svg class="relative w-14 h-14 text-indigo-300 dark:text-indigo-500"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent">
                            </div>
                        </div>

                        <div class="p-7">
                            @if ($isEnrolled)
                                <div class="space-y-4">
                                    @if ($isCourseCompleted)
                                        <div
                                            class="flex items-center justify-center gap-2 text-amber-700 dark:text-amber-300 bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/30 dark:to-yellow-900/20 py-3 rounded-xl border border-amber-200 dark:border-amber-700/50 mb-2">
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-bold text-sm">Course Completed 🎓</span>
                                        </div>
                                    @else
                                        <div
                                            class="flex items-center justify-center gap-2 text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 py-3 rounded-xl border border-emerald-100 dark:border-emerald-700/50 mb-2">
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-bold text-sm">Successfully Enrolled</span>
                                        </div>
                                    @endif

                                    <!-- Progress Bar -->
                                    <div class="mb-3">
                                        <div class="flex justify-between items-center mb-2 px-0.5">
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Your
                                                Progress</span>
                                            <span
                                                class="text-xs font-bold tabular-nums {{ $isCourseCompleted ? 'text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-500/10' : 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10' }} px-2 py-0.5 rounded-md">{{ $progressPercentage }}%</span>
                                        </div>
                                        <div
                                            class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2 overflow-hidden">
                                            <div class="h-full rounded-full transition-all duration-700 ease-out {{ $isCourseCompleted ? 'bg-gradient-to-r from-amber-400 to-yellow-400' : 'bg-gradient-to-r from-indigo-500 to-violet-500' }}"
                                                style="width: {{ $progressPercentage }}%"></div>
                                        </div>
                                    </div>

                                    @if ($resumeLesson)
                                        <a href="{{ route('lesson.show', [$course->slug, $resumeLesson->id]) }}"
                                            wire:navigate
                                            class="w-full flex items-center justify-center px-6 py-4 text-base font-bold rounded-xl text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98]">
                                            {{ $isCourseCompleted ? 'Review Course' : 'Continue Learning' }}
                                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="space-y-5">
                                    <div class="flex flex-col text-center">
                                        <span class="text-2xl font-black text-slate-900 dark:text-white mb-1">FREE
                                            ACCESS</span>
                                        <span
                                            class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Enrollment
                                            is open</span>
                                    </div>
                                    <button wire:click="enroll" wire:loading.attr="disabled"
                                        class="w-full flex items-center justify-center px-6 py-4 text-base font-bold rounded-xl text-white shimmer-bg animate-shimmer shadow-2xl shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span wire:loading.remove wire:target="enroll">Enroll in Course</span>
                                        <span wire:loading wire:target="enroll" class="flex items-center">
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                            Processing...
                                        </span>
                                    </button>
                                    <p class="text-xs text-center text-slate-400 leading-relaxed">
                                        Includes full lifetime access, all video lessons, and verified certification
                                        upon completion.
                                    </p>
                                </div>
                            @endif

                            <!-- Course Includes -->
                            <div class="mt-8 pt-8 border-t border-slate-100 dark:border-slate-800">
                                <h4
                                    class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-widest mb-5">
                                    This course
                                    includes:</h4>
                                <ul class="space-y-4">
                                    <li class="flex items-center text-sm text-slate-600 dark:text-slate-300">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                            <svg class="h-4 w-4 text-indigo-500 dark:text-indigo-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        {{ $course->lessons->count() }} high-quality video lessons
                                    </li>
                                    <li class="flex items-center text-sm text-slate-600 dark:text-slate-300">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                            <svg class="h-4 w-4 text-indigo-500 dark:text-indigo-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        Industry recognized certification
                                    </li>
                                    <li class="flex items-center text-sm text-slate-600 dark:text-slate-300">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center mr-3 flex-shrink-0">
                                            <svg class="h-4 w-4 text-indigo-500 dark:text-indigo-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                        Full lifetime access & mobile friendly
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
