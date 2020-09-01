<template>
  <div class="login">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-8 login-box mx-auto">
        <div class="col-lg-12 login-title">
          Login
        </div>

        <div class="col-lg-9 mx-auto login-form">
          <form>
            <div class="form-group">
              <label class="form-control-label">User Name</label>
              <input
                type="text"
                class="form-control"
                v-model="formData.name"
              >
            </div>
            <div class="form-group">
              <label class="form-control-label">PASSWORD</label>
              <input
                type="password"
                class="form-control"
                v-model="formData.password"
              >
            </div>
            <p class="text-danger" v-if="errors.name">{{errors.name[0]}}</p>
            <div class="login-btm login-button">
              <button
                class="btn btn-outline-primary"
                @click.prevent="handleLogin"
              >LOGIN</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      formData: {
        name: "",
        password: "",
      },
      errors: {

      }
    };
  },
  methods: {
    handleLogin() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/login", this.formData)
          .then((res) => {
              console.log(res);
            this.$router.push("/admin");
          })
          .catch((err) => {
            console.log(err.response);
            this.errors = err.response.data.errors;
          });
      });
    },
  },
};
</script>

<style scoped>
.login {
  height: 100%;
  background: #222d32;
  font-family: "Roboto", sans-serif;
}

.login-box {
  margin-top: 75px;
  height: auto;
  background: #1a2226;
  text-align: center;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.login-key {
  height: 100px;
  font-size: 80px;
  line-height: 100px;
  background: -webkit-linear-gradient(#27ef9f, #0db8de);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.login-title {
  margin-top: 15px;
  text-align: center;
  font-size: 30px;
  letter-spacing: 2px;
  margin-top: 15px;
  font-weight: bold;
  color: #ecf0f5;
}

.login-form {
  margin-top: 25px;
  text-align: left;
}

input[type="text"] {
  background-color: #1a2226;
  border: none;
  border-bottom: 2px solid #0db8de;
  border-top: 0px;
  border-radius: 0px;
  font-weight: bold;
  outline: 0;
  margin-bottom: 20px;
  color: #ecf0f5;
}

input[type="password"] {
  background-color: #1a2226;
  border: none;
  border-bottom: 2px solid #0db8de;
  border-top: 0px;
  border-radius: 0px;
  font-weight: bold;
  outline: 0;
  margin-bottom: 20px;
  color: #ecf0f5;
}

.form-group {
  margin-bottom: 20px;
  outline: 0px;
}

.form-control:focus {
  border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-bottom: 2px solid #0db8de;
  outline: 0;
  background-color: #1a2226;
  color: #ecf0f5;
}

input:focus {
  outline: none;
  box-shadow: 0 0 0;
}

label {
  margin-bottom: 0px;
}

.form-control-label {
  font-size: 10px;
  color: #6c6c6c;
  font-weight: bold;
  letter-spacing: 1px;
}

.btn-outline-primary {
  border-color: #0db8de;
  color: #0db8de;
  border-radius: 0px;
  font-weight: bold;
  letter-spacing: 1px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.btn-outline-primary:hover {
  background-color: #0db8de;
  color: white;
  right: 0px;
}

.login-btm {
  float: left;
}

.login-button {
  width: 100%;
  display: flex;
  justify-content: center;
  padding-right: 0px;
  margin-bottom: 25px;
}

.login-text {
  text-align: left;
  padding-left: 0px;
  color: #a2a4a4;
}

.loginbttm {
  padding: 0px;
}
</style>
