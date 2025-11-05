<script setup>
import {ref} from 'vue';

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
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
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
            // Extract validation errors
            if (data.errors) {
                message.value = Object.values(data.errors).flat().join(', ');
            } else {
                message.value = data.message || 'Error';
            }
            isError.value = true;
        }
    } catch (error) {
        message.value = 'Error: ' + error.message;
        isError.value = true;
    }
};
</script>

<template>
    <div style="padding: 20px;">
        <input v-model="uuid" placeholder="uuid" style="border: 1px solid #ccc; padding: 5px;">
        <input v-model.number="battery_percent" type="number" placeholder="battery_percent" style="border: 1px solid #ccc; padding: 5px;">
        <button @click="send">Send</button>

        <div v-if="message" :style="{ backgroundColor: isError ? 'red' : 'green', padding: '10px', marginTop: '10px', color: 'white' }">
            {{ message }}
        </div>
    </div>
</template>
