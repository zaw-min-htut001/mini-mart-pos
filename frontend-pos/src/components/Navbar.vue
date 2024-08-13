<template>
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="shrink-0 flex items-center justify-between w-full h-14">
                <h1 class="text-xl font-bold">POS Dashboard</h1>
                <div v-if="token" class="flex shrink-0 items-center gap-3">
                    <h1 class="text-blue-90000">
                        Login as : {{ user.name }} <br> {{ user.email }}
                    </h1>
                    <button @click.prevent="submit()"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapActions, mapGetters } from 'vuex/dist/vuex.cjs.js';
import Swal from 'sweetalert2'
export default {
    computed: {
        ...mapGetters(['token', 'user'])
    },
    methods: {
        ...mapActions(['logout']),
        submit() {
            Swal.fire({
                title: "Are you sure?",
                text: "You will logout",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.logout().then((res) => {
                        location.reload()
                    });     
                }
            });
        }
    }
};
</script>