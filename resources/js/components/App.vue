<script>
export default {
    data() { return { msg: null } },
    created() {
        window.Echo.channel('test').listen('EventNewArticle', (name) => {
            this.msg = name.article.title;
            alert('Добавлена новая статья!');
        })
        console.log("xd");
    }

}
</script>


<template>
    <div v-show="this.msg != null" class="alert alert-primary" role="alert">
        Добавлена новая статья <strong>{{ this.msg }}</strong>
    </div>
</template>


<style scoped>
/* .alert {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #f44336;
    color: white;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}

.alert button {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 16px;
    margin-left: 15px;
} */
</style>

