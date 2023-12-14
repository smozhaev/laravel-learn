<script>
export default {
    data() { return { msg: null } },
    created() {
        window.Echo.channel('my-channel').listen('ArticleCreateEvent', (name) => {
            console.log(name);
            this.msg = name.name;
            alert('Добавлена новая статья!');
        })
    }
}
</script>


<template>
    <div v-if="msg" class="alert">
        <span>{{ msg }}</span>
        <button @click="closeAlert">Закрыть</button>
    </div>
</template>


<style scoped>
.alert {
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
}
</style>

