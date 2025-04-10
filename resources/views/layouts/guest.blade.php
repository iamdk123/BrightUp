<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- Tailwind -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            navy: {
                                50: '#f5f7fa',
                                100: '#eaeef4',
                                200: '#d5dfe9',
                                300: '#b3c5d9',
                                400: '#8aa3c4',
                                500: '#6784b0',
                                600: '#4c6a96',
                                700: '#3d567a',
                                800: '#334663',
                                900: '#1a2437',
                            },
                            mustard: {
                                50: '#fefbe8',
                                100: '#fff7c2',
                                200: '#ffea89',
                                300: '#ffd649',
                                400: '#ffc71f',
                                500: '#faa307',
                                600: '#dc7902',
                                700: '#b75506',
                                800: '#94410c',
                                900: '#7a360d',
                            }
                        },
                    }
                }
            }
        </script>
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Styles -->
        <style>
            [x-cloak] { display: none !important; }
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        @yield('content')
    </body>
</html>
