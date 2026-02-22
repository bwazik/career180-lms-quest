<div class="bg-slate-50 dark:bg-slate-950 min-h-screen">
    @push('styles')
        <link rel="stylesheet" href="https://cdn.plyr.io/3.8.4/plyr.css" />
    @endpush

    <!-- Theater Mode Header -->
    <div
        class="bg-white dark:bg-slate-900 border-b border-slate-200/80 dark:border-slate-700/80 sticky top-16 z-40 shadow-sm shadow-slate-200/50 dark:shadow-black/20">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('course.show', $course->slug) }}" wire:navigate
                        class="group p-2.5 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all duration-200">
                        <svg class="h-5 w-5 group-hover:-translate-x-0.5 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <p
                            class="text-[10px] font-bold uppercase tracking-widest text-indigo-500 dark:text-indigo-400 mb-0.5">
                            {{ $course->title }}</p>
                        <h1
                            class="text-base lg:text-lg font-bold text-slate-900 dark:text-white leading-tight line-clamp-1">
                            {{ $lesson->title }}</h1>
                    </div>
                </div>

                <!-- Progress Bar Section -->
                <div class="flex items-center space-x-4 md:w-1/3" x-data="{ progress: {{ $progressPercentage }} }"
                    @progress-updated.window="progress = $event.detail.progress">
                    <div class="flex-grow">
                        <div class="flex justify-between items-center mb-2 px-0.5">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Course
                                Progress</span>
                            <span
                                class="text-xs font-bold text-indigo-600 dark:text-indigo-400 tabular-nums bg-indigo-50 dark:bg-indigo-500/10 px-2 py-0.5 rounded-md"
                                x-text="progress + '%'">{{ $progressPercentage }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-violet-500 transition-all duration-1000 ease-out relative"
                                :style="'width: ' + progress + '%'">
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent animate-shimmer"
                                    style="background-size: 200% 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">

            <!-- Left: Video + Lesson Details + Completion (col-span-3) -->
            <div class="lg:col-span-3 space-y-6">

                <!-- Video Section -->
                <div>
                    <div class="relative">
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-indigo-500/10 to-violet-500/10 rounded-3xl blur-2xl -z-10">
                        </div>
                        <div
                            class="aspect-video bg-slate-900 rounded-2xl shadow-2xl shadow-slate-900/30 overflow-hidden ring-1 ring-white/10">
                            <div wire:ignore x-data="{
                                player: null,
                                lastSaved: {{ (int) $watchSeconds }},
                                initPlayer() {
                                    if (typeof Plyr === 'undefined') {
                                        setTimeout(() => this.initPlayer(), 100);
                                        return;
                                    }
                                    this.player = new Plyr(this.$refs.video);

                                    this.player.on('timeupdate', () => {
                                        let current = Math.floor(this.player.currentTime);
                                        if (current - this.lastSaved >= 10) {
                                            this.lastSaved = current;
                                            this.$wire.updateWatchSeconds(current);
                                        }
                                    });
                                }
                            }" x-init="initPlayer()"
                                class="aspect-video w-full h-full">

                                <video x-ref="video" controls playsinline>
                                    <source src="{{ asset('videos/sample.mp4') }}" type="video/mp4">
                                </video>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lesson Meta & Completion -->
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">
                    <!-- Lesson Details -->
                    <div class="xl:col-span-2">
                        <div
                            class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200/80 dark:border-slate-700/80 p-8">
                            @if (session()->has('message'))
                                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-xl border border-emerald-100 dark:border-emerald-700/50 flex items-center">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-800/50 flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="h-4 w-4 text-emerald-600 dark:text-emerald-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="font-semibold text-sm">{{ session('message') }}</p>
                                </div>
                            @endif

                            <div class="flex items-center gap-3 mb-5">
                                <div
                                    class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-slate-900 dark:text-white">Lesson Details</h2>
                            </div>

                            <p class="text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                                This lesson covers key concepts within the <span
                                    class="font-bold text-indigo-600 dark:text-indigo-400">{{ $course->title }}</span>
                                course.
                                Follow along carefully and don't forget to mark the lesson as completed when finished.
                            </p>

                            <div class="flex items-center gap-6 text-sm text-slate-400 font-medium">
                                <span
                                    class="flex items-center gap-1.5 bg-slate-50 dark:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-100 dark:border-slate-700">
                                    <svg class="h-4 w-4 text-indigo-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ floor($lesson->duration_seconds / 60) }}m {{ $lesson->duration_seconds % 60 }}s
                                </span>
                                <span
                                    class="flex items-center gap-1.5 bg-slate-50 dark:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-100 dark:border-slate-700">
                                    <svg class="h-4 w-4 text-indigo-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    Lesson Resource Available
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Completion Card -->
                    <div class="xl:col-span-1" x-data="{ open: false }">
                        <div
                            class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200/80 dark:border-slate-700/80 p-8 text-center">
                            @if ($isCompleted)
                                <div class="flex flex-col items-center">
                                    <div class="relative mb-5">
                                        <div
                                            class="absolute -inset-2 bg-emerald-100 dark:bg-emerald-500/20 rounded-full blur-lg opacity-60">
                                        </div>
                                        <div
                                            class="relative h-16 w-16 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-500 dark:text-emerald-400 rounded-2xl flex items-center justify-center">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Lesson Completed!
                                    </h3>
                                    <p class="text-sm text-slate-400 mb-6">Great job! Keep the momentum going.</p>
                                    @if ($nextLesson)
                                        <a href="{{ route('lesson.show', [$course->slug, $nextLesson->id]) }}"
                                            wire:navigate
                                            class="w-full py-4 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl font-bold shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98] inline-flex items-center justify-center">
                                            Next Lesson
                                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                    @else
                                        <a href="{{ route('course.show', $course->slug) }}" wire:navigate
                                            class="w-full py-4 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-700/50 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-emerald-100 dark:hover:bg-emerald-800/50 transition-colors duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                            </svg>
                                            Course Completed! Back to Overview
                                        </a>
                                    @endif
                                </div>
                            @elseif(Auth::check())
                                <div class="flex flex-col items-center">
                                    <div class="relative mb-5">
                                        <div
                                            class="absolute -inset-2 bg-indigo-100 dark:bg-indigo-500/20 rounded-full blur-lg opacity-50 animate-pulse">
                                        </div>
                                        <div
                                            class="relative h-16 w-16 bg-indigo-50 dark:bg-indigo-900/50 text-indigo-500 dark:text-indigo-400 rounded-2xl flex items-center justify-center animate-pulse-glow">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Finish this
                                        lesson?</h3>
                                    <p class="text-sm text-slate-400 mb-6 leading-relaxed">Mark this lesson as
                                        completed to
                                        track your progress and unlock the next module.</p>
                                    <button @click="open = true"
                                        class="w-full py-4 shimmer-bg animate-shimmer text-white rounded-xl font-bold shadow-2xl shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98]">
                                        Complete Lesson
                                    </button>
                                </div>

                                <!-- Confirmation Modal -->
                                <div x-show="open" x-cloak class="fixed inset-0 z-[60] overflow-y-auto">
                                    <div class="flex items-center justify-center min-h-screen p-4">
                                        <div @click="open = false" x-show="open"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                                        <div x-show="open" x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                                            class="bg-white dark:bg-slate-900 rounded-2xl p-8 max-w-sm w-full relative z-[70] shadow-2xl shadow-slate-900/20 text-center border border-slate-200/80 dark:border-slate-700/80">
                                            <div class="relative mx-auto mb-5 w-14 h-14">
                                                <div
                                                    class="absolute -inset-2 bg-indigo-100 dark:bg-indigo-500/20 rounded-full blur-lg opacity-60">
                                                </div>
                                                <div
                                                    class="relative w-14 h-14 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center">
                                                    <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Well
                                                done!</h3>
                                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-8 leading-relaxed">
                                                Confirming this will mark the lesson as finished and update your overall
                                                progress.</p>
                                            <div class="grid grid-cols-2 gap-3">
                                                <button @click="open = false"
                                                    class="py-3 text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 rounded-xl transition-all duration-200">
                                                    Cancel
                                                </button>
                                                <button @click="open = false; $wire.markAsCompleted()"
                                                    class="py-3 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-500/25 transition-all duration-200 transform active:scale-95">
                                                    Yes, I'm done!
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col items-center">
                                    <div class="relative mb-5">
                                        <div
                                            class="absolute -inset-2 bg-slate-200 dark:bg-slate-600/20 rounded-full blur-lg opacity-50">
                                        </div>
                                        <div
                                            class="relative h-16 w-16 bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 rounded-2xl flex items-center justify-center">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Track Your
                                        Progress</h3>
                                    <p class="text-sm text-slate-400 mb-6 leading-relaxed">Sign in to mark lessons as
                                        completed, track your course progress, and pick up where you left off.</p>
                                    <a href="{{ route('login') }}"
                                        class="w-full py-4 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl font-bold shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98] inline-flex items-center justify-center">
                                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                        Log In
                                    </a>
                                    <a href="{{ route('register') }}"
                                        class="w-full mt-3 py-3.5 text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 bg-indigo-50 dark:bg-indigo-500/10 hover:bg-indigo-100 dark:hover:bg-indigo-500/20 border border-indigo-100 dark:border-indigo-500/20 rounded-xl transition-all duration-200 inline-flex items-center justify-center">
                                        Create Account
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Course Lessons Sidebar (col-span-1) -->
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-[8.5rem]">
                    <div
                        class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200/80 dark:border-slate-700/80 overflow-hidden">

                        <!-- Sidebar Header -->
                        <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-800">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-violet-50 dark:bg-violet-500/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-violet-600 dark:text-violet-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Course Content</h3>
                                </div>
                                <span
                                    class="text-[10px] font-bold text-slate-400 bg-slate-50 dark:bg-slate-800 px-2 py-1 rounded-md border border-slate-100 dark:border-slate-700">
                                    {{ $allLessons->count() }} lessons
                                </span>
                            </div>
                        </div>

                        <!-- Scrollable Lesson List -->
                        <div
                            class="max-h-[calc(100vh-12rem)] overflow-y-auto scrollbar-thin scrollbar-thumb-slate-200 dark:scrollbar-thumb-slate-700 scrollbar-track-transparent">
                            <div class="divide-y divide-slate-50 dark:divide-slate-800/50">
                                @foreach ($allLessons as $sidebarLesson)
                                    @php
                                        $isActive = $sidebarLesson->id === $lesson->id;
                                        $canAccess = $isEnrolled || $sidebarLesson->is_free_preview;
                                        $isDone = in_array($sidebarLesson->id, $completedLessonIds);
                                    @endphp

                                    @if ($canAccess)
                                        <a href="{{ route('lesson.show', [$course->slug, $sidebarLesson->id]) }}"
                                            wire:navigate
                                            class="flex items-center gap-3 px-5 py-3.5 transition-all duration-200 group relative
                                                {{ $isActive
                                                    ? 'bg-indigo-50/80 dark:bg-indigo-500/10 border-l-[3px] border-l-indigo-500'
                                                    : 'hover:bg-slate-50 dark:hover:bg-slate-800/50 border-l-[3px] border-l-transparent' }}">
                                            <!-- Status Icon -->
                                            <div class="flex-shrink-0">
                                                @if ($isDone)
                                                    <div
                                                        class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center">
                                                        <svg class="w-3.5 h-3.5 text-emerald-500 dark:text-emerald-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="3" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>
                                                @elseif ($isActive)
                                                    <div
                                                        class="w-7 h-7 rounded-lg bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                                        <div
                                                            class="w-2.5 h-2.5 bg-indigo-500 rounded-full animate-pulse">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center group-hover:bg-indigo-50 dark:group-hover:bg-indigo-500/10 transition-colors">
                                                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-indigo-500 transition-colors"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Lesson Info -->
                                            <div class="flex-grow min-w-0">
                                                <p
                                                    class="text-[13px] font-semibold leading-tight line-clamp-1
                                                    {{ $isActive
                                                        ? 'text-indigo-700 dark:text-indigo-300'
                                                        : ($isDone
                                                            ? 'text-slate-500 dark:text-slate-400'
                                                            : 'text-slate-700 dark:text-slate-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400') }}
                                                    transition-colors">
                                                    {{ $sidebarLesson->title }}
                                                </p>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span class="text-[11px] text-slate-400 flex items-center">
                                                        <svg class="w-3 h-3 mr-0.5" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ floor($sidebarLesson->duration_seconds / 60) }}:{{ str_pad($sidebarLesson->duration_seconds % 60, 2, '0', STR_PAD_LEFT) }}
                                                    </span>
                                                    @if ($sidebarLesson->is_free_preview && !$isEnrolled)
                                                        <span
                                                            class="text-[9px] font-bold uppercase tracking-wider text-emerald-500 bg-emerald-50 dark:bg-emerald-900/30 px-1.5 py-0.5 rounded">Free</span>
                                                    @endif
                                                </div>
                                            </div>

                                            @if ($isActive)
                                                <div class="flex-shrink-0">
                                                    <span
                                                        class="text-[9px] font-bold uppercase tracking-wider text-indigo-500 bg-indigo-100 dark:bg-indigo-900/50 px-2 py-1 rounded-md">Now</span>
                                                </div>
                                            @endif
                                        </a>
                                    @else
                                        {{-- Locked lesson --}}
                                        <div
                                            class="flex items-center gap-3 px-5 py-3.5 cursor-not-allowed opacity-50 border-l-[3px] border-l-transparent">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-grow min-w-0">
                                                <p
                                                    class="text-[13px] font-semibold text-slate-400 dark:text-slate-500 leading-tight line-clamp-1">
                                                    {{ $sidebarLesson->title }}
                                                </p>
                                                <span class="text-[11px] text-slate-400 flex items-center mt-1">
                                                    <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ floor($sidebarLesson->duration_seconds / 60) }}:{{ str_pad($sidebarLesson->duration_seconds % 60, 2, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.plyr.io/3.8.4/plyr.js"></script>
    @endpush
</div>
