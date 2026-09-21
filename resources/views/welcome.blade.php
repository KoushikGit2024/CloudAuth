<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudAuth Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-3 font-semibold text-lg text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><line x1="3" x2="21" y1="9" y2="9"/><line x1="9" x2="9" y1="21" y2="9"/></svg>
            CloudAuth
        </div>
        <div>
            @if ($user)
                <span class="text-gray-500 mr-5 text-sm font-medium">{{ $user['email'] ?? $user['username'] }}</span>
                <a href="/auth/logout" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Sign Out</a>
            @else
                <a href="/auth/login" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition">Sign In</a>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
            
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-900 mb-2">Welcome Back</h1>
            <p class="text-gray-500 text-sm mb-8">
                Please sign in to access the secure dashboard. Authentication is handled securely via AWS Cognito.
            </p>
            
            @if ($user)
                <div class="flex flex-col gap-3">
                    <a href="/dashboard" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition duration-200">
                        Continue to Dashboard
                    </a>
                </div>
            @else
                <a href="/auth/login" class="w-full flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-medium py-2.5 rounded-lg transition duration-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 8-6 4 6 4V8Z"/><circle cx="8" cy="12" r="6"/></svg>
                    Continue with AWS Cognito
                </a>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 text-center text-gray-400 text-xs">
        <p>CloudAuth &mdash; Laravel & AWS Cognito Integration</p>
    </footer>

</body>
</html>
