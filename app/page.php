<div class="min-h-screen bg-black text-zinc-100 overflow-hidden">
    <!-- Ambient glow / blur blobs -->
    <div class="pointer-events-none fixed inset-0">
        <div class="absolute -top-56 left-1/2 -translate-x-1/2 h-[620px] w-[620px] rounded-full bg-orange-500/20 blur-3xl"></div>
        <div class="absolute top-40 -left-48 h-[520px] w-[520px] rounded-full bg-orange-400/10 blur-3xl"></div>
        <div class="absolute bottom-[-220px] right-[-220px] h-[720px] w-[720px] rounded-full bg-orange-600/10 blur-3xl"></div>

        <!-- vignette + soft top light -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(255,255,255,0.07),transparent_55%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_35%,rgba(0,0,0,0.75))]"></div>

        <!-- subtle grid -->
        <div class="absolute inset-0 opacity-[0.16]
            [background-image:linear-gradient(to_right,rgba(255,255,255,0.055)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.055)_1px,transparent_1px)]
            [background-size:84px_84px]"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-6 py-16 sm:py-24">
        <!-- Top bar -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <!-- outer glow -->
                    <div class="absolute -inset-3 rounded-3xl bg-orange-500/15 blur-2xl"></div>

                    <!-- logo badge -->
                    <div class="group relative rounded-2xl p-[1px]
                        bg-gradient-to-b from-white/15 via-white/5 to-white/0
                        shadow-[0_0_0_1px_rgba(255,255,255,0.06),0_18px_60px_rgba(0,0,0,0.6)]
                        transition hover:shadow-[0_0_0_1px_rgba(255,255,255,0.10),0_24px_90px_rgba(0,0,0,0.75)]">

                        <div class="relative rounded-2xl bg-white/[0.05] backdrop-blur-xl
                            flex items-center justify-center
                            h-16 w-16
                            border border-white/10
                            transition group-hover:bg-white/[0.07]">

                            <img src="/favicon.ico" alt="Reqziel" class="w-10 h-10 drop-shadow-[0_8px_18px_rgba(0,0,0,0.55)]">
                        </div>
                    </div>
                </div>

                <div class="select-none">
                    <div class="text-lg font-semibold tracking-wide">Reqziel</div>
                    <div class="text-xs text-zinc-400">Minimal PHP Framework</div>
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-2 text-xs text-zinc-400">
                <span class="rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 backdrop-blur-md">
                    v1.0.0
                </span>
                <span class="rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 backdrop-blur-md">
                    PHP
                </span>
            </div>
        </div>

        <!-- Hero -->
        <div class="mt-16 sm:mt-20">
            <!-- premium gradient border wrapper -->
            <div class="relative rounded-[28px] p-[1px]
                bg-gradient-to-b from-white/12 via-white/6 to-white/0
                shadow-[0_30px_140px_rgba(0,0,0,0.70)]">

                <div class="relative rounded-[28px] border border-white/10 bg-white/[0.035] backdrop-blur-2xl p-10 sm:p-14">
                    <!-- inner glows -->
                    <div class="pointer-events-none absolute inset-0 rounded-[28px]
                        bg-[radial-gradient(1200px_circle_at_18%_0%,rgba(249,115,22,0.16),transparent_45%)]"></div>
                    <div class="pointer-events-none absolute inset-0 rounded-[28px]
                        bg-[radial-gradient(900px_circle_at_88%_18%,rgba(251,146,60,0.10),transparent_52%)]"></div>

                    <!-- soft highlight line -->
                    <div class="pointer-events-none absolute inset-x-0 top-0 h-px
                        bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

                    <div class="relative">
                        <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-black/30 px-4 py-2 text-xs text-zinc-300 backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-orange-500 shadow-[0_0_22px_rgba(249,115,22,0.70)]"></span>
                            Ready to build something clean
                        </div>

                        <h1 class="mt-6 text-4xl sm:text-6xl font-bold tracking-tight">
                            Welcome to
                            <span class="bg-gradient-to-r from-orange-300 via-orange-500 to-amber-200 bg-clip-text text-transparent drop-shadow-[0_10px_35px_rgba(249,115,22,0.10)]">
                                Reqziel
                            </span>
                        </h1>

                        <p class="mt-5 text-base sm:text-lg text-zinc-300/90 max-w-2xl leading-relaxed">
                            Get started by editing
                            <code class="mx-1 inline-flex items-center justify-center
                                rounded-lg border border-white/10
                                bg-black/40
                                px-2.5 py-2
                                text-orange-300
                                leading-none
                                shadow-[inset_0_1px_0_rgba(255,255,255,0.06)]">
                                app/page.php
                            </code>

                            and make it yours.
                        </p>

                        <!-- Bottom hint -->
                        <div class="mt-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-zinc-400">
                                Tip: keep components in <span class="text-zinc-200">app/</span> and public assets in <span class="text-zinc-200">public/</span>.
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-10 text-center text-xs text-zinc-500">
                © <?= date('Y') ?> Reqziel
            </div>
        </div>
    </div>
</div>