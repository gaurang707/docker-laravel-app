<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    {!! Devrabiul\ToastMagic\Facades\ToastMagic::styles() !!}
    <style>
        :root {
            --bg: #f4f6fb;
            --surface: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --primary: #3b82f6;
            --danger: #ef4444;
            --shadow: 0 12px 24px rgba(15, 23, 42, .08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", "Segoe UI", Roboto, sans-serif;
            margin: 0;
            padding: 0;
            background: var(--bg);
            color: var(--text);
        }

        .app-shell {
            min-height: 100vh;
            display: grid;
            grid-template-rows: auto 1fr;
        }

        .header {
            background: #2f4f7c;
            color: #fff;
            padding: 16px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
            font-weight: 600;
        }

        .page-content {
            width: min(1100px, 100% - 32px);
            margin: 24px auto;
            padding: 18px;
            background: var(--surface);
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .page-title {
            margin: 0;
            font-size: 1.7rem;
            color: #152238;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 0.65rem 1rem;
            border-radius: 8px;
            transition: transform .15s ease, filter .15s ease;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
        }

        .btn:hover {
            filter: brightness(.95);
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-danger {
            background: var(--danger);
        }

        .datatable-container {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: .35rem .5rem;
        }

        table.dataTable thead th {
            background: #f8fafc;
            color: var(--text);
            font-weight: 600;
        }

        table.dataTable tbody tr:hover {
            background: rgba(59, 130, 246, 0.08);
        }

        @media (max-width: 900px) {
            .page-content {
                margin: 16px;
                padding: 12px;
            }

            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .toolbar .btn {
                width: 100%;
            }

            .page-title {
                font-size: 1.45rem;
            }
        }
    </style>
</head>

<body>
    <div class="app-shell">
        <header class="header">
            <nav style="display: flex; align-items: center; justify-content: space-between; gap:12px; flex-wrap:wrap;">
                <div style="font-weight:700;">MyApp</div>


                <div style="display:flex; gap:10px;">

                    @php
                        use Illuminate\Support\Facades\Cache;

                        $menus = Cache::rememberForever('header_menu', function () {
                            return config('menu.header');
                        });
                    @endphp

                    @foreach ($menus as $menu)
                        <a class="btn btn-outline" style="padding:.45rem .75rem;" href="{{ route($menu['route']) }}">
                            {{ $menu['title'] }}
                        </a>
                    @endforeach

                    {{-- <a href="{{ route('home') }}" class="btn btn-outline" style="padding:.45rem .75rem;">Home</a>
                    <a href="{{ route('about') }}" class="btn btn-outline" style="padding:.45rem .75rem;">About Us</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline" style="padding:.45rem .75rem;">Contact</a>
                    <a href="{{ route('users.index') }}" class="btn" style="padding:.45rem .75rem;">Users</a> --}}
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                {!! session('toast') ?? '' !!}

                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    {!! Devrabiul\ToastMagic\Facades\ToastMagic::scripts() !!}
    @stack('scripts')
</body>

</html>
