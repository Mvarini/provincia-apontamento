{{-- resources/views/maintenance.blade.php --}}
    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Em Manutenção</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, hsl(240 15% 6%) 0%, hsl(250 20% 10%) 50%, hsl(240 15% 4%) 100%);
        }

        @keyframes twinkle {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0);
            }
            33% {
                transform: translateY(-20px) translateX(10px);
            }
            66% {
                transform: translateY(10px) translateX(-5px);
            }
        }

        @keyframes float-slow {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse-glow {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.1);
            }
        }

        @keyframes orbit {
            0% {
                transform: rotate(0deg) translateX(60px) rotate(0deg);
            }
            100% {
                transform: rotate(360deg) translateX(60px) rotate(-360deg);
            }
        }

        @keyframes orbit-reverse {
            0% {
                transform: rotate(360deg) translateX(50px) rotate(-360deg);
            }
            100% {
                transform: rotate(0deg) translateX(50px) rotate(0deg);
            }
        }

        @keyframes rocket {
            0%, 100% {
                transform: rotate(-45deg) translateY(0);
            }
            50% {
                transform: rotate(-45deg) translateY(-5px);
            }
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-twinkle {
            animation: twinkle 2s ease-in-out infinite;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: float-slow 4s ease-in-out infinite;
        }

        .animate-pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .animate-orbit {
            animation: orbit 10s linear infinite;
        }

        .animate-orbit-reverse {
            animation: orbit-reverse 8s linear infinite;
        }

        .animate-rocket {
            animation: rocket 2s ease-in-out infinite;
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }

        .star {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
        }

        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(99, 102, 241, 0.3);
            border-radius: 50%;
        }
    </style>
</head>
<body class="min-h-screen overflow-hidden flex items-center justify-center relative">

{{-- Animated Stars Background --}}
<div id="stars" class="absolute inset-0 overflow-hidden"></div>

{{-- Floating Particles --}}
<div id="particles" class="absolute inset-0 overflow-hidden pointer-events-none"></div>

{{-- Main Content --}}
<div class="relative z-10 text-center px-6 max-w-2xl mx-auto animate-fade-in">

    {{-- Animated Icon Container --}}
    <div class="relative mb-8 inline-block">
        {{-- Glow Effect --}}
        <div class="absolute inset-0 bg-indigo-500/20 blur-3xl rounded-full animate-pulse-glow"></div>

        {{-- Main Icon Circle --}}
        <div
            class="relative bg-white/5 backdrop-blur-sm border border-indigo-500/20 rounded-full p-8 animate-float-slow">
            {{-- Rocket Icon (SVG) --}}
            <svg class="w-16 h-16 text-indigo-400 animate-rocket" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/>
                <path
                    d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/>
                <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/>
                <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/>
            </svg>
        </div>

        {{-- Orbiting Settings Icon --}}
        <div class="absolute inset-0 animate-orbit">
            <svg class="absolute -top-2 left-1/2 -translate-x-1/2 w-5 h-5 text-indigo-400/60"
                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
        </div>

        {{-- Orbiting Sparkles Icon --}}
        <div class="absolute inset-0 animate-orbit-reverse">
            <svg class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-4 h-4 text-purple-400"
                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/>
                <path d="M5 3v4"/>
                <path d="M19 17v4"/>
                <path d="M3 5h4"/>
                <path d="M17 19h4"/>
            </svg>
        </div>
    </div>

    {{-- Title --}}
    <h1 class="text-4xl md:text-4xl font-bold mb-4 tracking-tight">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-300 via-purple-300 to-indigo-300">
                Em Manutenção
            </span>
    </h1>

    {{-- Subtitle --}}
    <p class="text-lg md:text-xl text-gray-400 mb-8 leading-relaxed">
        Estou trabalhando para trazer melhorias incríveis para você.
        <br>
        Voltaremos em breve!
    </p>


    {{-- Title --}}
    <h1 class="text-4xl md:text-5xl font-bold mb-4 tracking-tight">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 via-purple-400 to-indigo-400">
                Marciel Alessandro Varini
            </span>
    </h1>


    {{-- Estimated Return Badge --}}
    {{--    <div--}}
    {{--        class="inline-flex items-center gap-3 bg-white/5 backdrop-blur-sm border border-indigo-500/20 rounded-full px-6 py-3">--}}
    {{--        <div class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></div>--}}
    {{--        <span class="text-gray-400 text-sm">--}}
    {{--                Previsão de retorno: <span class="text-white font-medium">'2 horas'</span>--}}
    {{--            </span>--}}
    {{--    </div>--}}

    {{-- Decorative Line --}}
    <div class="mt-12 flex items-center justify-center gap-2">
        <div class="h-px w-16 bg-gradient-to-r from-transparent to-indigo-500/50"></div>
        <svg class="w-4 h-4 text-indigo-500/50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path
                d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/>
        </svg>
        <div class="h-px w-16 bg-gradient-to-l from-transparent to-indigo-500/50"></div>
    </div>
</div>

{{-- Bottom Glow Effect --}}
<div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-96 h-32 bg-indigo-500/10 blur-[100px] rounded-full"></div>

<script>
    // Generate Stars
    const starsContainer = document.getElementById('stars');
    for (let i = 0; i < 50; i++) {
        const star = document.createElement('div');
        star.className = 'star animate-twinkle';
        star.style.left = Math.random() * 100 + '%';
        star.style.top = Math.random() * 100 + '%';
        star.style.animationDelay = Math.random() * 3 + 's';
        star.style.opacity = Math.random() * 0.7 + 0.3;
        starsContainer.appendChild(star);
    }

    // Generate Particles
    const particlesContainer = document.getElementById('particles');
    for (let i = 0; i < 8; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle animate-float';
        particle.style.left = (10 + i * 12) + '%';
        particle.style.top = (20 + (i % 3) * 30) + '%';
        particle.style.animationDelay = (i * 0.5) + 's';
        particlesContainer.appendChild(particle);
    }
</script>
</body>
</html>

