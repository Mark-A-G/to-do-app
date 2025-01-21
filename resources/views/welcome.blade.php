<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel with React</title>
    @viteReactRefresh <!-- This will allow 'npm run dev' to work -->
    @vite('resources/js/app.js')  <!-- This will load the React bundle -->
    <!-- Styles -->
    @vite('resources/css/app.css')
</head>
<body>
<div id="app"></div>  <!-- React will render here -->
</body>
</html>
