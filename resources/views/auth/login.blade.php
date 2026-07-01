<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAP PAY - Administrative Control Hub</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .cyber-mesh {
            background-image: 
                radial-gradient(at 10% 20%, rgba(56, 189, 248, 0.15) 0px, transparent 45%),
                radial-gradient(at 90% 10%, rgba(99, 102, 241, 0.12) 0px, transparent 45%),
                radial-gradient(at 50% 80%, rgba(20, 184, 166, 0.08) 0px, transparent 50%);
        }
    </style>
</head>
<body class="h-full font-sans antialiased text-slate-700 selection:bg-indigo-500/10 overflow-x-hidden flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 cyber-mesh relative bg-gradient-to-tr from-slate-100 via-slate-50 to-sky-100/30">

    <!-- TECHNICAL SYSTEM LINE INFRASTRUCTURE -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(148,163,184,0.12)_1px,transparent_1px),linear-gradient(to_bottom,rgba(148,163,184,0.12)_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] pointer-events-none"></div>

    <!-- MAIN INTERFACE CONSOLE SURFACE -->
    <div class="w-full max-w-5xl bg-white/70 backdrop-blur-2xl border border-slate-200/80 rounded-[2.5rem] shadow-[0_25px_70px_-15px_rgba(148,163,184,0.25)] p-1 sm:p-2 lg:p-3 relative overflow-hidden">
        
        <!-- Subtle Vector Border Glow Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-sky-400/20 via-transparent to-indigo-400/20 rounded-[2.5rem] pointer-events-none"></div>

        <!-- Inner Layout Container Block -->
        <div class="bg-white/80 rounded-[2.2rem] p-6 sm:p-10 lg:p-14 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-center">
            
            <!-- LEFT TELEMETRY FRAME (Lg: 5 Columns) -->
            <div class="lg:col-span-5 space-y-10 lg:pr-6">
                
                <!-- System Active HUD Badge -->
                <div class="inline-flex items-center space-x-2.5 bg-sky-50 border border-sky-200 px-3.5 py-1.5 rounded-full text-[10px] uppercase tracking-[0.25em] font-black text-sky-600 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                    <span>System Active Node</span>
                </div>

                <!-- High-End Branding Architecture -->
                <div class="space-y-4">
                    <h1 class="text-5xl lg:text-6xl font-black tracking-tight text-slate-900 leading-none">
                        PAP <br class="hidden lg:block"/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-500 via-indigo-500 to-blue-600">PAY</span>
                    </h1>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">School Payroll Network Architecture</p>
                </div>

                <!-- Strategic Context Block -->
                <p class="text-sm text-slate-500 font-normal leading-relaxed">
                    A streamlined digital interface engine engineered for parsing administrative calculations, personnel accounts, and continuous infrastructure auditing.
                </p>

                <!-- UI Live Telemetry Fields -->
                <div class="grid grid-cols-2 gap-3 pt-6 border-t border-slate-100">
                    <div class="bg-slate-50/80 border border-slate-200/60 p-3.5 rounded-xl shadow-sm">
                        <div class="text-[9px] text-slate-400 uppercase tracking-widest font-black">CORE VER</div>
                        <div class="text-xs font-mono font-bold text-sky-600 mt-1">4.2.1//STABLE</div>
                    </div>
                    <div class="bg-slate-50/80 border border-slate-200/60 p-3.5 rounded-xl shadow-sm">
                        <div class="text-[9px] text-slate-400 uppercase tracking-widest font-black">DATA ACCESS</div>
                        <div class="text-xs font-mono font-bold text-indigo-600 mt-1 flex items-center gap-1.5">
                            <span class="h-1 w-1 rounded-full bg-indigo-500"></span>
                            SSL_SECURED
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT AUTHENTICATION MODULE (Lg: 7 Columns) -->
            <div class="lg:col-span-7 bg-slate-50/50 border border-slate-200 p-6 sm:p-10 rounded-3xl relative overflow-hidden shadow-inner">
                
                <!-- Ambient Backdrop Aura Behind Inputs -->
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-sky-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Identity Authentication</h2>
                    <p class="text-xs text-slate-400 mt-1">Inject authorization parameters to initiate link bypass.</p>
                </div>

                <!-- Live Laravel Feedback Panel -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-xs text-emerald-700 rounded-xl shadow-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Input Element Form Grid -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Identity Field Block -->
                    <div class="space-y-2">
                        <label for="email" class="block text-[10px] font-black uppercase tracking-[0.15em] text-sky-600">
                            Clearance Access Handle (Email)
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="operator@system.edu"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-300 text-sm focus:outline-none focus:border-sky-500 focus:ring-4 focus:ring-sky-100 transition-all duration-300 font-mono shadow-sm"
                        />
                        @if ($errors->has('email'))
                            <p class="text-xs text-rose-600 font-medium mt-1.5 tracking-wide">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <!-- Passkey Field Block -->
                    <div class="space-y-2">
                        <label for="password" class="block text-[10px] font-black uppercase tracking-[0.15em] text-sky-600">
                            Secure Network Cipher (Password)
                        </label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="••••••••••••"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-300 text-sm focus:outline-none focus:border-sky-500 focus:ring-4 focus:ring-sky-100 transition-all duration-300 font-mono shadow-sm"
                        />
                        @if ($errors->has('password'))
                            <p class="text-xs text-rose-600 font-medium mt-1.5 tracking-wide">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <!-- Form Navigation Control Matrix -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center group cursor-pointer select-none">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                name="remember"
                                class="w-4 h-4 rounded border-slate-300 bg-white text-sky-500 focus:ring-0 focus:ring-offset-0 focus:outline-none checked:bg-sky-500 checked:border-sky-500 transition duration-150"
                            >
                            <span class="ml-2.5 text-xs font-bold text-slate-400 group-hover:text-sky-500 transition duration-150">
                                PERSIST RECON-LINK
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-sky-600 hover:text-sky-500 transition duration-150 uppercase tracking-wider">
                                Recover Access?
                            </a>
                        @endif
                    </div>

                    <!-- Authorization Interface Trigger Link -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-sky-500 via-indigo-500 to-blue-600 hover:from-sky-400 hover:to-indigo-500 text-white py-4 px-6 rounded-xl font-black text-xs tracking-[0.2em] uppercase transition duration-300 shadow-md shadow-sky-200 active:scale-[0.99] transform active:translate-y-0"
                        >
                            Establish Database Connection
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- GLOBAL FOOTER LOGISTIC MATRIX -->
    <p class="absolute bottom-4 left-0 right-0 text-center text-slate-400 text-[9px] tracking-[0.3em] font-black uppercase pointer-events-none">
        &copy; {{ date('Y') }} PAP PAY // DISTRIBUTED ADMINISTRATION NET NODE // ALL RIGHTS PROTECTED.
    </p>

</body>
</html>