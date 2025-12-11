<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* Improve select visibility on dark/orange background without changing theme */
        .select {
            background-color: rgba(255,255,255,0.95) !important;
            color: #0f172a !important;
            border: 1px solid rgba(15,23,42,0.12) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.18);
            padding: .5rem .75rem;
            border-radius: .375rem;
        }
        .select:focus, .select:active {
            outline: none;
            box-shadow: 0 6px 20px rgba(0,0,0,0.28), 0 0 0 4px rgba(255,255,255,0.04);
        }
        .select option {
            color: #0f172a;
            background-color: #fff;
        }
        /* inputs already use bg-[#fff] but ensure text contrast */
        .input, textarea, .textarea { color: #0f172a; }
        /* Subtle improvements for button visibility on orange background
           Do not change colors or theme — only increase contrast and hover feedback */
        .btn {
            transition: box-shadow .12s ease, transform .08s ease, background-color .12s;
            box-shadow: 0 2px 6px rgba(2,6,23,0.06);
            border-color: rgba(15,23,42,0.08);
        }
        .btn:hover {
            box-shadow: 0 8px 24px rgba(2,6,23,0.12);
            transform: translateY(-1px);
        }
        /* Outline / ghost buttons: add subtle backdrop and stronger border for contrast */
        .btn.btn-outline, .btn.btn-ghost {
            background-color: rgba(255,255,255,0.04);
            border-color: rgba(255,255,255,0.14);
            color: inherit;
        }
        .btn.btn-outline:hover, .btn.btn-ghost:hover {
            background-color: rgba(255,255,255,0.10);
            border-color: rgba(255,255,255,0.22);
        }
        /* Toolbar-specific: ensure join toolbar buttons and icons are white for contrast */
        .join .btn, .join .btn span { color: #ffffff !important; }
        .join .btn svg, .join .btn .size-6 { color: #ffffff !important; fill: #ffffff !important; }

        /* Table/action buttons: ensure icons and text are visible on dark rows */
        table .btn { color: #ffffff !important; }
        table .btn svg { fill: #ffffff !important; color: #ffffff !important; }

        /* Inputs/selects placed inside labels with text-white should show white text and placeholders */
        .label.text-white input,
        .label.text-white select,
        .label.text-white textarea { color: #ffffff !important; }
        .label.text-white input::placeholder,
        .label.text-white textarea::placeholder { color: rgba(255,255,255,0.7) !important; }

        /* Search input wrapper often uses `label.input.text-white` (see pets index) */
        label.input.text-white { color: #ffffff !important; }
        label.input.text-white input { color: #ffffff !important; background-color: rgba(255,255,255,0.04) !important; }
        label.input.text-white input::placeholder { color: rgba(255,255,255,0.7) !important; }
        /* Make search icon inside that label white and fully visible */
        label.input.text-white svg, label.input.text-white .h\[1em\], label.input.text-white .opacity-50 {
            fill: #ffffff !important; color: #ffffff !important; stroke: #ffffff !important; opacity: 1 !important;
        }
        /* Also ensure inputs using the `input text-white` classes are white */
        .input.text-white { color: #ffffff !important; }

        /* Make disabled buttons still readable */
        .btn[disabled], .btn:disabled { opacity: 0.95; color: #ffffff !important; }
        /* Ensure outline buttons that are intended to be white keep white text/icons
           Some DaisyUI rules may set color from parent — use a specific selector. */
        .btn.btn-outline.text-white,
        .btn.btn-outline.text-white svg,
        .btn.btn-outline.text-white * {
            color: #ffffff !important;
            fill: #ffffff !important;
        }

        /* Basic emulation of Tailwind `md:` utilities so responsive classes work
           even when Tailwind isn't fully processed. This ensures classes like
           `md:table-cell`, `md:inline`, `md:flex`, `md:block` behave across views.
        */
        /* Mobile-first defaults */
        .md\:table-cell { display: none; }
        .md\:inline { display: none; }
        .md\:flex { display: none; }
        .md\:block { display: none; }
        .md\:hidden { display: block; }

        @media (min-width: 768px) {
            .md\:table-cell { display: table-cell !important; }
            .md\:inline { display: inline !important; }
            .md\:flex { display: flex !important; }
            .md\:block { display: block !important; }
            .md\:hidden { display: none !important; }
        }
    </style>
</head>
@php
if(Auth::user()->role == 'Administrator') {
$image = 'images/pets-dashboard-2.png';
} else {
$image = 'images/pets-dashboard.png';
}
@endphp

<body class="min-h-[100dvh] bg-[url({{ asset($image) }})] bg-center bg-cover bg-fixed flex flex-col gap-4 items-center justify-center w-full flex p-6 pt-20 ">
    @include('layouts.navbar')
    @yield('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        @auth
        const _role = "{{ Auth::user()->role }}";
        document.addEventListener('input', e=>{
            if(e.target?.id==='qsearch' && ['users','pets','adoptions'].includes(e.target.value.trim().toLowerCase()) && _role!=='Administrator'){
                const d=document.getElementById('modal_error'); if(d?.showModal){ const t=document.getElementById('modal_error_text'); if(t) t.innerText = `Access denied: only admins can view '${e.target.value.trim()}'`; d.showModal(); }
            }
        });
        @endauth
    </script>
    @yield('js')

</body>
</html>