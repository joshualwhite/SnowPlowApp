<h2>Garden Hut Snow Plow</h2>
<p>This app was created by Alec Veer and Josh White, for Garden Hut to manage their snow plow routes efficiently</p>
<p><strong>Important</strong>This app is not the production level app, if you clone and deploy this app please not this is not the final version and the API routes are not protected by authentication. DO NOT deploy this app for use. Please contact us for the production level application.
<h3>Setup</h3>
<ol>
    <li>git clone https://github.com/joshualwhite/SnowPlowApp/</li>
    <li>cd SnowPlowApp</li>
    <li>composer install</li>
    <li>npm install</li>
    <li>cp .env.example .env</li>
    <li>create database and edit .env</li>
    <liphp artisan key:generate</li>
    <li>php artisan migrate</li>
    <li>php artisan db:seed</li>
</ol>
