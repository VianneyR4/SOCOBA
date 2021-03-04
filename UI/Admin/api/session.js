localStorage.getItem("token") == null ? window.location = SOURCE_URL + "UI/Admin/login.php?status=0" : "";
// localStorage.getItem("token") == null ? window.location = "login.php?status=0" : "";
console.log("Token kye", localStorage.getItem("token"));

new Vue({
    el: '#app',
    data() {
        return {
            admin: "",
            token: null,
            // SOURCE_URL: 'file:///D:/Sonia/',
            SOURCE_URL: 'http://localhost/SOCOBA/',
            showAccountDropdownVar: false,
        }
    },
    mounted() {
        this.token = localStorage.getItem("token");
        getProfile(this.token).then(
            (response) => {
                if (response.status == 201) {
                    this.admin = response.profile;
                    console.log("profile: ", this.admin);
                } else {
                    console.log("User not found with status ", response.status, "Message: ", response.message);
                    window.location = this.SOURCE_URL + "UI/Admin/login.php?status=1";
                }
            }
        )
    },
    methods: {
        // showAccountDropdown() {
        //     showAccountDropdownVar
        // }
    }
})

const logout = () => {
    alert("You're about to logout!");
    localStorage.removeItem("token");
    localStorage.getItem("token") == null ? window.location = SOURCE_URL + "UI/Admin/login.php" : "";
}


let header = {
    template: `<div>
    
    </div>`
}