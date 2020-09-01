<template>
  <header>
    <div class="d-flex justify-content-between">
      <div class="left-area">
        <h3>Attendance</h3>
      </div>
      <div class="right-area">
        <div class="dropdown">
          <button
            class="btn btn-secondary dropdown-toggle"
            type="button"
            id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            {{userName}}
          </button>
          <div
            class="dropdown-menu"
            aria-labelledby="dropdownMenuButton"
          >
            <a
              class="dropdown-item"
              href="#"
            >Mark In</a>
            <a
              class="dropdown-item"
              href="#"
            >Mark Out</a>
            <a
              class="dropdown-item"
              href="#"
            >Break In</a>
            <a
              class="dropdown-item"
              href="#"
            >Break Out</a>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  props: { userName: null },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>

<style scoped>
header {
  background: #22242a;
  padding: 20px;
  width: 100%;
}
.left-area h3 {
  color: #fff;
  margin: 0;
  text-transform: uppercase;
  font-size: 22px;
  font-weight: 900;
}
</style>
