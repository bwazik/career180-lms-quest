<div>
    <!-- Hero Section -->
    <div
        class="relative bg-gradient-to-br from-slate-950 via-indigo-950 to-slate-900 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 overflow-hidden">
        <!-- Animated decorative blobs -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl animate-float"></div>
            <div class="absolute top-1/2 right-0 w-80 h-80 bg-violet-600/15 rounded-full blur-3xl animate-float-delay">
            </div>
            <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl animate-float-slow">
            </div>
            <!-- Grid pattern overlay -->
            <div class="absolute inset-0 opacity-[0.03]"
                style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23fff&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center min-h-[85vh] py-20 lg:py-28">
                <!-- Left Content -->
                <div class="text-center lg:text-left">
                    <div class="animate-fade-in-up">
                        <div
                            class="inline-flex items-center px-4 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 mb-8">
                            <span class="relative flex h-2 w-2 mr-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                            </span>
                            <span class="text-xs font-semibold text-indigo-300 tracking-wide uppercase">New courses
                                available</span>
                        </div>
                    </div>

                    <h1
                        class="animate-fade-in-up text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-black tracking-tight text-white leading-[1.1]">
                        Start your career journey with
                        <br>
                        <span class="text-gradient">Career180</span>
                    </h1>

                    <p
                        class="animate-fade-in-up-delay mt-6 text-lg sm:text-xl text-slate-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Career 180’s 4-week Summer Program is designed for university students and fresh graduates ready to take the next step.
                    </p>

                    <div
                        class="animate-fade-in-up-delay-2 mt-10 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#courses"
                            class="w-full sm:w-auto group inline-flex items-center justify-center px-8 py-4 shimmer-bg animate-shimmer text-white text-base font-bold rounded-2xl shadow-2xl shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                            Browse Courses
                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        @guest
                            <a href="{{ route('register') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 text-white text-base font-bold rounded-2xl transition-all duration-300 backdrop-blur-sm">
                                Get Started Free
                                <svg class="ml-2 w-5 h-5 opacity-60" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        @endguest
                    </div>

                    <!-- Trust indicators -->
                    <div
                        class="animate-fade-in-up-delay-2 mt-14 flex items-center justify-center lg:justify-start gap-8 text-sm text-slate-500">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Verified Certificates</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                            </svg>
                            <span>Lifetime Access</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Hero Image Carousel -->
                <div class="hidden lg:block relative" x-data="{
                    current: 0,
                    images: [
                        '{{ asset('images/hero1.jpg') }}',
                        '{{ asset('images/hero2.jpg') }}',
                        '{{ asset('images/hero3.jpg') }}',
                        '{{ asset('images/hero4.jpg') }}',
                        '{{ asset('images/hero5.jpg') }}'
                    ]
                }" x-init="setInterval(() => { current = (current + 1) % images.length }, 5000)">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-indigo-500/20 to-violet-500/20 rounded-3xl blur-2xl">
                    </div>
                    <div
                        class="relative rounded-3xl overflow-hidden shadow-2xl shadow-black/40 ring-1 ring-white/10 aspect-[4/3]">
                        <!-- Carousel Images -->
                        <template x-for="(img, index) in images" :key="index">
                            <img :src="img" alt="Students learning"
                                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out"
                                :class="current === index ? 'opacity-100' : 'opacity-0'">
                        </template>
                        <!-- Gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent">
                        </div>
                        <!-- Carousel Indicators -->
                        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex items-center gap-2 z-10">
                            <template x-for="(img, index) in images" :key="'dot-' + index">
                                <button @click="current = index"
                                    class="w-2 h-2 rounded-full transition-all duration-300 focus:outline-none"
                                    :class="current === index ? 'bg-white w-6' : 'bg-white/40 hover:bg-white/60'">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom gradient fade into content -->
        <div
            class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-slate-50 dark:from-slate-950 to-transparent">
        </div>
    </div>

    <!-- Courses Section -->
    <div id="courses" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="md:flex md:items-end md:justify-between mb-16">
            <div class="max-w-2xl">
                <span
                    class="inline-block text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 mb-3">Learn
                    &
                    Grow</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-slate-900 dark:text-white">
                    Featured Courses
                </h2>
                <p class="mt-4 text-lg text-slate-500 dark:text-slate-400 leading-relaxed">Choose from a variety of
                    paths specifically
                    designed for career growth and skill mastery.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($courses as $course)
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
                                    <svg class="relative w-12 h-12 text-indigo-300 dark:text-indigo-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
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
                                {{ $course->level->name }}
                            </span>
                        </div>
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
                            <span class="mx-2 text-slate-300 dark:text-slate-600">&bull;</span>
                            <span>Full Lifetime Access</span>
                        </div>

                        <h3
                            class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300 line-clamp-2 leading-snug">
                            {{ $course->title }}
                        </h3>

                        <p class="mt-3 text-slate-500 dark:text-slate-400 text-sm line-clamp-3 leading-relaxed">
                            {{ Str::limit($course->description, 140) }}
                        </p>

                        <div
                            class="mt-auto pt-6 flex items-center justify-between border-t border-slate-100 dark:border-slate-800">
                            <span
                                class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Explore
                                Course</span>
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
                </a>
            @empty
                <div class="col-span-full py-24 text-center">
                    <div class="max-w-sm mx-auto">
                        <div
                            class="w-20 h-20 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-300 dark:text-slate-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-700 dark:text-slate-300 mb-2">No courses yet</h3>
                        <p class="text-slate-400 text-sm">New courses are being added regularly. Check back soon for
                            exciting new content!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
