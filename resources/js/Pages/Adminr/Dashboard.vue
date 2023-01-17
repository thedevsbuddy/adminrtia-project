<template>

    <Head title="Dashboard" />
    <section>
        <page-header title="Dashboard" />
        <div class="@container ">
            <div class="grid @md:grid-cols-2 @3xl:grid-cols-3 @6xl:grid-cols-4 @md:gap-x-4 @3xl:gap-x-6 gap-y-4">
                <card class="!bg-accent text-light">
                    <card-content class="rounded">
                        <div class="min-h-[4rem] flex justify-end px-5 py-3">
                            <icon cicon name="people" class="w-12 h-12" />
                        </div>
                        <div class="px-4 py-2">
                            <p class="text-lg font-semibold">1.5M</p>
                            <span class="block text-sm uppercase">Users Registered</span>
                        </div>
                    </card-content>
                </card>
                <card class="!bg-emerald-500 text-white">
                    <card-content class="rounded">
                        <div class="min-h-[4rem] flex justify-end px-5 py-3">
                            <icon cicon name="book" class="w-12 h-12" />
                        </div>
                        <div class="px-4 py-2">
                            <p class="text-lg font-semibold">1.2K</p>
                            <span class="block text-sm uppercase">Articale Posted</span>
                        </div>
                    </card-content>
                </card>
            </div>
        </div>
    </section>
</template>
<script setup>

</script>
