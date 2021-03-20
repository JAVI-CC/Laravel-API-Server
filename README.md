<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

<h3>Demo API</h3>
<p>https://laravelapijuegos.herokuapp.com</p>

<h3>Documentation API SWAGGER 3.0</h3>
<p>http://laravelapijuegos.herokuapp.com/api/documentation</p>

<h3>.env</h3>
<p>API_KEY=$2y$10$f01jcbsMhFuNif8yHAotQuGr4OaqwfXi6g96Y4DHVIkw3HjQgMwMu</p>

<h3>HEADERS</h3>
<p>api-key=$2y$10$f01jcbsMhFuNif8yHAotQuGr4OaqwfXi6g96Y4DHVIkw3HjQgMwMu</p>

<h3>Requests API</h3>
<p>-Get all games: <strong>$this->client->request('GET', '/api/juegos')</strong> </p>
<p>-Get game: <strong>$this->client->request('GET', '/api/juegos/' . $slug)</strong></p>
<p>-Add game: <strong>$this->client->request('POST', '/api/juegos', ['form_params' => ['nombre' => $request->input('nombre'), 'desarrolladora' => $request->input('desarrolladora'), 'fecha' => $request->input('fecha'), 'descripcion' => $request->input('descripcion'),]]);</strong></p>
<p>-Update game: <strong>$this->client->request('PUT', '/api/juegos/' . $slug, ['form_params' => ['nombre' => $request->input('nombre'), 'desarrolladora' => $request->input('desarrolladora'), 'fecha' => $request->input('fecha'), 'descripcion' => $request->input('descripcion'),]]);</strong></p>
<p>-Delete game: <strong>$this->client->request('DELETE', '/api/juegos/delete/' . $slug);</strong></p>
<p>-Search game: <strong>$this->client->request('POST', '/api/juegos/filter/search', ['form_params' => ['search' => $search, 'filter' => $filter, 'order' => $order,]]);</strong></p>

<span>$search = 'name_game1';</span>
<span>$filter = 'nombre' or 'descripcion' or 'desarolladora' or 'fecha'</span>
<span>$order = 'ASC' or 'DESC'</span>
<hr>

