const app = new Vue({
  el: "#app",
  data: {
    datasrc: [],
    showEditModal: false,
    showModal: false, // Data source for displaying records
    editData: { id: null, Name: "", Age: 0, Tel: "" },
    formData: {
      Name: "",
      Age: "",
      Tel: "",
    },
    username: "",
    password: "",
    loginMode: true, // Data for editing
    // ... Other data properties ...
  },
  methods: {
    fetchData() {
      // Fetch data from the server using Axios
      axios
        .get("select.php")
        .then((response) => {
          this.datasrc = response.data; // Update data source
        })
        .catch((error) => {
          console.error(error);
        });
    },
    addData() {
      // Add data to the server using Axios
      const formData = new FormData(
        document.querySelector("#registrationForm")
      );
      axios
        .post("insert.php", formData)
        .then((response) => {
          console.log(response.data);
          this.formData.Name = "";
          this.formData.Age = "";
          this.formData.Tel = "";
          this.fetchData();
          Swal.fire({
            title: "เพิ่มข้อมูลเรียบร้อย",
            icon: "success",
          }); // Refresh data
        })
        .catch((error) => {
          console.error(error);
        });
    },
    updateData() {
      // Show confirmation SweetAlert
      Swal.fire({
        title: "ต้องการแก้ไขข้อมูลหรือไม่ ?",
        text: "ตรวจสอบความถูกต้องทุกครั้งที่ทำการแก้ไข",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "ตกลง",
        cancelButtonText: "ยกเลิก",
      }).then((result) => {
        if (result.isConfirmed) {
          const formData = new FormData();
          formData.append("id", this.editData.id);
          formData.append("Name", this.editData.Name);
          formData.append("Age", this.editData.Age);
          formData.append("Tel", this.editData.Tel);

          axios
            .post("update.php", formData)
            .then((response) => {
              console.log(response.data);
              this.fetchData(); // Refresh data
              Swal.fire({
                icon: "success",
                title: "แก้ไขข้อมูลเรียบร้อย",
                showConfirmButton: false,
                timer: 1500,
              });
            })
            .catch((error) => {
              console.error(error);
              // Show error SweetAlert
              Swal.fire({
                icon: "error",
                title: "Error updating data",
                text: "An error occurred while updating the data.",
                showConfirmButton: false,
                timer: 1500,
              });
            });
        }
      });
    },
    deleteValue(id) {
      // Confirm with SweetAlert before proceeding with the deletion
      Swal.fire({
        title: "คุณต้องการลบหรือไม่ ?",
        text: "โปรดตรวจสอบให้แน่ใจก่อนว่าต้องการลบ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "ตกลง",
        cancelButtonText: "ยกเลิก",
      }).then((result) => {
        if (result.isConfirmed) {
          // Send the ID to PHP for deletion
          axios
            .post(
              "delete.php",
              { id: id },
              {
                headers: {
                  "Content-Type": "application/x-www-form-urlencoded",
                },
              }
            )
            .then((response) => {
              console.log(response.data); // Handle success response

              // Fetch data after successful deletion to update the table
              this.fetchData();

              // Show success message with SweetAlert
              Swal.fire({
                title: "ลบเรียบร้อย",
                text: "ข้อมูลถูกลบไปแล้ว",
                icon: "success",
              });
            })
            .catch((error) => {
              console.error(error); // Handle error
            });
        }
      });
    },

    preparedata(item) {
      // Prepare data for editing
      this.editData.id = item.id;
      this.editData.Name = item.Name;
      this.editData.Age = item.Age;
      this.editData.Tel = item.Tel;
      // ... (Other properties) ...
      $("#editModal").modal("show"); // Open modal
    },
    closeModal() {
      this.showModal = false;
      document.body.classList.remove("modal-open"); // Set the variable to false to hide the modal
    },
    loginOrRegister() {
      if (this.loginMode) {
        // เรียกใช้ฟังก์ชัน login เมื่อในโหมด Login
        this.login();
      } else {
        // เรียกใช้ฟังก์ชัน register เมื่อในโหมด Register
        this.register();
      }
    },
    toggleMode() {
      this.loginMode = !this.loginMode;
      this.username = '';
      this.password = '';
    },
    login() {
      const formData = new FormData();
      formData.append('username', this.username);
      formData.append('password', this.password);
  
      axios.post('logpass.php', formData)
        .then(response => {
          if (response.data.message === 'success') {
            // ถ้าเข้าสู่ระบบสำเร็จ นำทางไปหน้า index.html
            window.location.href = 'index.php';
          } else {
            alert('Invalid credentials. Please try again.');
          }
        })
        .catch(error => {
          console.error(error);
        });
    },
    register() {
      const formData = new FormData();
      formData.append('username', this.username);
      formData.append('password', this.password);
  
      axios.post('insertpass.php', formData)
        .then(response => {
          if (response.data.message === 'success') {
            // ถ้าสมัครสมาชิกสำเร็จ
            Swal.fire({
              icon: 'success',
              title: 'ลงทะเบียนสำเร็จ',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              // นำทางไปหน้า index.html
              window.location.href = 'login.php';
            });
          } else {
            alert('Registration failed. Please try again.');
          }
        })
        .catch(error => {
          console.error(error);
        });
  }

    // ... Other methods ...
  },
  created() {
    this.fetchData();
    // Fetch data on component load
  },
});
