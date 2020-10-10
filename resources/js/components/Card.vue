<template>
    <card class="flex flex-col items-center justify-center">
        <div class="flex px-3 py-3">
            <div class="mt-3" v-if="logSize.length">
                {{ __('Log Size') }}: <code>{{ logSize }}</code>
            </div>
            <div class="flex-2 pr-8 pl-3 text-right">
                <div class="flex flex-col">
                    <button class="btn btn-default btn-danger" v-on:click="isFlushModalOpen = true">
                        {{ __('Flush') }}
                    </button>
                </div>
            </div>
        </div>
        <portal to="modals">
            <transition name="fade">
                <confirm-flush-log-modal
                    v-if="isFlushModalOpen"
                    @confirm="onFlush()"
                    @close="isFlushModalOpen = false"
                />
            </transition>
        </portal>
    </card>
</template>

<script>
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    data() {
        return {
            isFlushModalOpen: false,
            logSize: this.card.logSize,
        }
    },

    methods: {
        onFlush() {
            Nova.request().post('/nova-vendor/nova-log-cleaner/flush').then(response => {
                if (!response.data.success) {
                    this.toastFlushLogFailed();
                } else {
                    this.toastFlushLogSuccess();
                }
                this.logSize = response.data.size;
            });
            this.isFlushModalOpen = false;
        },
        toastFlushLogSuccess() {
            this.$toasted.show(
                this.__('Successfully flushed the log!'),
                { type: 'success' }
            );
        },
        toastFlushLogFailed() {
            this.$toasted.show(
                this.__('There was an issue flushing the log!'),
                { type: 'error' }
            );
        },
    },
}
</script>
