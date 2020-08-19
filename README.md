<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

<h3>Demo API</h3>
<p>https://laravelapijuegos.herokuapp.com</p>

<h3>.env</h3>
<p>API_KEY=58cd1658e9a605d139043ef426e16b9d</p>

<h3>Requests API</h3>
<p>-Get all games: <strong>$this->client->request('GET', '/api/juegos')</strong> </p>
<p>-Get game: <strong>$this->client->request('GET', '/api/juegos/' . $id)</strong></p>
<p>-Add game: <strong>$this->client->request('POST', '/api/juegos', ['form_params' => ['nombre' => $request->input('nombre'), 'desarrolladora' => $request->input('desarrolladora'), 'fecha' => $request->input('fecha'), 'descripcion' => $request->input('descripcion'),]]);</strong></p>
<p>-Update game: <strong>$this->client->request('POST', '/api/juegos/' . $id, ['form_params' => ['nombre' => $request->input('nombre'), 'desarrolladora' => $request->input('desarrolladora'), 'fecha' => $request->input('fecha'), 'descripcion' => $request->input('descripcion'),]]);</strong></p>
<p>-Delete game: <strong>$this->client->request('GET', '/api/juegos/delete/' . $id);</strong></p>
<p>-Search game (None of the parameters are required.): <strong>$this->client->request('POST', '/api/juegos/filter/search', ['form_params' => ['search' => $request->input('search'), 'filter' => $filter, 'order' => $order,]]);</strong></p>

<span>$search = 'name_game1';</span>
<span>$filter = 'nombre' or 'descripcion' or 'desarolladora' or 'fecha'</span>
<span>$order = 'ASC' or 'DESC'</span>
<hr>

