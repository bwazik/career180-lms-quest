<div class="bg-slate-50 dark:bg-slate-950 min-h-screen">

    <!-- Hero Header -->
    <div class="relative overflow-hidden">
        <div
            class="absolute inset-0 bg-gradient-to-br from-indigo-600/5 via-violet-500/5 to-slate-50 dark:from-indigo-600/10 dark:via-violet-500/5 dark:to-slate-950">
        </div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-violet-400/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-indigo-500 dark:text-indigo-400 mb-2">
                        Welcome back</p>
                    <h1 class="text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white">
                        {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="mt-2 text-slate-500 dark:text-slate-400 max-w-lg">
                        Track your progress, pick up where you left off, and keep learning.
                    </p>
                </div>

                <a href="/" wire:navigate
                    class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl font-bold text-sm shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98] self-start md:self-auto">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Browse Courses
                </a>
            </div>

            @if ($courses->count() > 0)
                <!-- Stats Row -->
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mt-8">
                    <div
                        class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-sm">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-slate-900 dark:text-white tabular-nums">
                                    {{ $courses->count() }}</p>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Enrolled</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-sm">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-slate-900 dark:text-white tabular-nums">
                                    {{ $totalCompleted }}</p>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Completed</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-2 lg:col-span-1 bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-sm">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-violet-50 dark:bg-violet-500/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-violet-600 dark:text-violet-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-slate-900 dark:text-white tabular-nums">
                                    {{ $overallProgress }}%</p>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Avg Progress
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Course Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

        @if ($courses->count() > 0)
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">My Courses</h2>
                <span
                    class="text-xs font-bold text-slate-400 bg-slate-100 dark:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700">
                    {{ $courses->count() }} {{ Str::plural('course', $courses->count()) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courses as $course)
                    <a href="{{ route('course.show', $course->slug) }}" wire:navigate
                        class="group relative flex flex-col bg-white dark:bg-slate-900 rounded-2xl shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-500 overflow-hidden border border-slate-200/80 dark:border-slate-700/80 hover:border-indigo-200 dark:hover:border-indigo-700 transform hover:-translate-y-1">
                        <!-- Thumbnail -->
                        <div
                            class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-slate-100 via-indigo-50 to-slate-100 dark:from-slate-800 dark:via-slate-700 dark:to-slate-800">
                            @if ($course->image)
                                <img src="{{ $course->image->url }}" alt="{{ $course->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center transform group-hover:scale-105 transition-transform duration-700 ease-out">
                                    <div class="relative">
                                        <div
                                            class="absolute -inset-4 bg-indigo-200/60 dark:bg-indigo-500/20 rounded-full blur-xl">
                                        </div>
                                        <svg class="relative w-12 h-12 text-indigo-300 dark:text-indigo-500"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                </div>
                            @endif
                            <!-- Overlay gradient -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <!-- Level badge -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-lg text-[11px] font-bold bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm text-indigo-700 dark:text-indigo-400 shadow-lg shadow-black/5 border border-white/50 dark:border-slate-600/50 uppercase tracking-wider">
                                    {{ $course->level->name ?? 'Course' }}
                                </span>
                            </div>
                            <!-- Completed badge -->
                            @if ($course->is_course_completed)
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-500/90 backdrop-blur-sm text-white rounded-lg text-[10px] font-bold uppercase tracking-wider shadow-lg">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Completed
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <div
                                class="flex items-center text-[11px] font-semibold text-slate-400 mb-3 uppercase tracking-wider">
                                <svg class="w-3.5 h-3.5 mr-1 text-indigo-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $course->lessons_count }} Lessons</span>
                            </div>

                            <h3
                                class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300 line-clamp-2 leading-snug">
                                {{ $course->title }}
                            </h3>

                            <!-- Progress + CTA -->
                            <div class="mt-auto pt-5">
                                <div class="flex justify-between items-center mb-1.5">
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Progress</span>
                                    <span
                                        class="text-xs font-bold tabular-nums {{ $course->is_course_completed ? 'text-amber-600 dark:text-amber-400' : 'text-indigo-600 dark:text-indigo-400' }}">
                                        {{ round($course->progress) }}%
                                    </span>
                                </div>
                                <div
                                    class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2 overflow-hidden mb-5">
                                    <div class="h-full rounded-full transition-all duration-700 ease-out {{ $course->is_course_completed ? 'bg-gradient-to-r from-amber-400 to-yellow-400' : 'bg-gradient-to-r from-indigo-500 to-violet-500' }}"
                                        style="width: {{ $course->progress }}%"></div>
                                </div>

                                <div
                                    class="flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-5">
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                                        {{ $course->is_course_completed ? 'Review Course' : 'Continue Learning' }}
                                    </span>
                                    <div
                                        class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 group-hover:bg-indigo-600 flex items-center justify-center transition-all duration-300">
                                        <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400 group-hover:text-white transform group-hover:translate-x-0.5 transition-all duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-20">
                <div class="relative mb-8">
                    <div
                        class="absolute -inset-6 bg-gradient-to-r from-indigo-500/10 to-violet-500/10 rounded-full blur-2xl">
                    </div>
                    <div
                        class="relative w-24 h-24 bg-gradient-to-br from-indigo-50 to-violet-50 dark:from-indigo-900/30 dark:to-violet-900/30 rounded-3xl flex items-center justify-center border border-indigo-100 dark:border-indigo-800/50">
                        <svg class="w-12 h-12 text-indigo-400 dark:text-indigo-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-3">No courses yet</h2>
                <p class="text-slate-500 dark:text-slate-400 text-center max-w-md mb-8 leading-relaxed">
                    You haven't enrolled in any courses yet. Browse our catalog and find the perfect course to start
                    your learning journey.
                </p>

                <a href="/" wire:navigate
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl font-bold shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Explore Courses
                </a>
            </div>
        @endif
    </div>
</div>
