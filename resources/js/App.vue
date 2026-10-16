<template>
    <v-app>
        <v-app-bar color="primary">
            <v-app-bar-title>
                Mans Laravel + Vue projekts
            </v-app-bar-title>
        </v-app-bar>

        <v-main>
            <v-container class="py-10">
                <v-card max-width="500" class="mx-auto pa-6">
                    <v-card-title>
                        Sveiki, Vuetify!
                    </v-card-title>

                    <v-card-text>
                        Laravel + Vue 3 + Vuetify 3 darbojas!
                    </v-card-text>

                    <v-btn
                        color="primary"
                        prepend-icon="mdi-thumb-up"
                        @click="count++"
                    >
                        Klikšķini: {{ count }}
                    </v-btn>
                </v-card>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import { ref } from 'vue';

const count = ref(0);
</script>