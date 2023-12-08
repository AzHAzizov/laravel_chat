import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            component: () => import("../pages/Home.vue"),
        },
        {
            path: "/about",
            component: () => import("../pages/About.vue"),
        },
        {
            path: "/user/login",
            component: () => import("../pages/user/Login.vue"),
            name: "user.login",
        },
        {
            path: "/user/registration",
            component: () => import("../pages/user/Registration.vue"),
            name: "user.registration",
        },
        // {
        //     path: "/users/personal",
        //     component: () => import("../pages/user/Personal.vue"),
        //     name: "user.personal",
        // },
    ],
});

router.beforeEach((to, from, next) => {
    // axios
    //     .get("/api/user")
    //     .then((res) => {
    //         console.log(res.data);
    //     })
    //     .catch((e) => {
    //         if (e.response.status === 401) {
    //             localStorage.key("x_xsrf_token")
    //                 ? localStorage.removeItem("x_xsrf_token")
    //                 : "";
    //         }
    //     });

    const token = localStorage.getItem("x_xsrf_token");

    if (!token) {
        if (to.name === "user.login" || to.name === "user.registration") {
            return next();
        } else {
            return next({
                name: "user.login",
            });
        }
    }

    if (
        (to.name === "user.login" || to.name === "user.registration") &&
        token
    ) {
        return next({
            name: "user.personal",
        });
    }

    return next();
});

export default router;
