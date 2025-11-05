<!-- resources/js/Pages/Ping.vue -->
<script setup>
import { ref } from 'vue';

const uuid = ref('');
const battery_percent = ref(0);
const message = ref('');
const isError = ref(false);

const send = async () => {
    message.value = '';

    try {
        const response = await fetch('/api/ping', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                uuid: uuid.value,
                battery_percent: battery_percent.value
            })
        });

        const data = await response.json();

        if (response.ok && data.status === 'ok') {
            message.value = 'OK';
            isError.value = false;
            uuid.value = '';
            battery_percent.value = 0;
        } else {
            message.value = 'Error';
            isError.value = true;
        }
    } catch (error) {
        message.value = 'Error';
        isError.value = true;
    }
};
</script>

<template>
    <div>
        <input v-model="uuid" placeholder="uuid">
        <input v-model.number="battery_percent" type="number" placeholder="battery_percent">
        <button @click="send">Send</button>

        <div v-if="message" :style="{ backgroundColor: isError ? 'red' : 'green', padding: '10px', marginTop: '10px' }">
            {{ message }}
        </div>
    </div>
</template>
