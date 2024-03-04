<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/login.css">
    <title>Document</title>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">
<div id="app">
<div class="card">
    <div class="card-body">
      <h1 class="card-title text-center">{{ loginMode ? 'Login' : 'Register' }}</h1>
      <form @submit.prevent="loginOrRegister">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" v-model="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" v-model="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">{{ loginMode ? 'Login' : 'Register' }}</button>
        <button type="button" class="btn btn-link mt-2" @click="toggleMode">
          {{ loginMode ? 'Register here' : 'Login here' }}
        </button>
      </form>
    </div>
  </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/vue.js"></script>
</body>

</html>