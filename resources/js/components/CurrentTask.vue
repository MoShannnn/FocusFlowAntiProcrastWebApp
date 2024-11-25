<template>
    <div
        class="w-10/12 max-w-[850px] h-[50px] relative current-task"
        style="margin: 72px auto 30px"
    >
        <div
            class="w-full h-[50px] top-0 absolute rounded-[20px] shadow border-4 border-[#3b1161] xl:text-2xl lg:text-xl font-normal tracking-widest flex items-center justify-center"
        >
            UI Design for Focus Flow
        </div>

        <div
            class="responsiveTop w-5 h-[50px] left-[20px] top-[50px] absolute origin-top-left -rotate-180 bg-[#a24bf4] rounded-tr-[50px] rounded-br-[50px]"
        ></div>
        <div
            class="w-5 h-[50px] right-[0px] top-[0px] absolute bg-[#a24bf4] rounded-tr-[50px] rounded-br-[50px]"
        ></div>
    </div>
</template>

<style>
@media (max-width: 1024px) and (max-height: 720px) {
    .current-task {
        margin: 20px auto 30px !important;
        height: 30px !important;
    }
    .current-task > div {
        height: 40px !important;
    }
    .responsiveTop {
        top: 40px !important;
    }
}
</style>
