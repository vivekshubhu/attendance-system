<template>
  <div class="h-100">
    <Navbar :userName="user.name" />
    <div class="d-flex h-100">
      <div class="sidebar">
        <a href="#"><i class="fa fa-desktop"></i><span>Dashboard</span></a>
        <a href="#"><i class="fa fa-user"></i><span>Users</span></a>
        <a @click="handleLogout"><i class="fa fa-sign-out-alt"></i><span>Logout</span></a>
      </div>
      <Dashboard />
    </div>
  </div>
</template>

<script>
import Dashboard from "./Dashboard";
export default {
  components: {
    Dashboard,
  },
  mounted() {
    axios
      .get("/api/user")
      .then((res) => {
        this.user = res.data;
        // console.log(res.data);
      })
      .catch((err) => {
        console.log(err.response);
      });
  },
  data() {
    return {
      user: {},
    };
  },
  methods: {
    async handleLogout() {
      await axios.get("/sanctum/csrf-cookie");
      await axios.post("/logout");
      this.$router.push("/login");
    },
  },
};
</script>

<style scoped>
.sidebar {
  background: #2f323a;
  padding-top: 30px;
  left: 0px;
  width: 250px;
  height: 100%;
  transition: 0.5s;
  transition-property: left;
}
.sidebar .profile-img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin-bottom: 10px;
}
.sidebar h4 {
  color: #ccc;
  margin-top: 0;
  margin-bottom: 20px;
}
.sidebar a {
  color: #fff;
  display: block;
  width: 100%;
  line-height: 60px;
  text-decoration: none;
  padding-left: 40px;
  box-sizing: border-box;
  transition: 0.5s;
  transition-property: background;
}
.sidebar a:hover {
  background: #1983d3;
}
.sidebar i {
  padding-right: 10px;
}
</style>
