<template>
    <ul
        class="gap-3 overflow-y-auto overflow-x-hidden text-white transition-all duration-200 space-y-3"
    >
        <li class="group transition-all duration-200">
            <a
                href="/"
                :class="toggleSidebar ? 'flex flex-row items-start' : ''"
                class="font-medium cursor-pointer relative hover:text-white"
            >
                <span
                    class="whitespace-nowrap"
                    :class="[
                        isActive('/') && toggleSidebar
                            ? 'bg-[rgba(255,255,255,0.35)] group-hover:!bg-[rgba(255,255,255,0.35)]'
                            : '',
                        toggleSidebar
                            ? 'flex-1 text-xsm transition duration-300 h-10 flex items-center pl-2 group-hover:bg-[rgba(255,255,255,0.2)]'
                            : 'block mx-auto mt-1 text-center text-[10px]',
                    ]"
                >
                    Home
                </span>
            </a>
        </li>
        <li>
            <Dialog>
      <DialogTrigger asChild>
        <Button variant="outline">Edit Profile</Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Edit profile</DialogTitle>
          <DialogDescription>
            Make changes to your profile here. Click save when you're done.
          </DialogDescription>
        </DialogHeader>
        <div className="grid gap-4 py-4">
          <div className="grid grid-cols-4 items-center gap-4">
            <Label htmlFor="name" className="text-right">
              Name
            </Label>
            <Input
              id="name"
              defaultValue="Pedro Duarte"
              className="col-span-3"
            />
          </div>
          <div className="grid grid-cols-4 items-center gap-4">
            <Label htmlFor="username" className="text-right">
              Username
            </Label>
            <Input
              id="username"
              defaultValue="@peduarte"
              className="col-span-3"
            />
          </div>
        </div>
        <DialogFooter>
          <Button type="submit">Save changes</Button>
        </DialogFooter>
      </DialogContent>
    </Dialog>
        </li>
    </ul>
</template>

<script setup>
import { ref } from "vue";
import { Button } from "@/components/ui/button"
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"

const props = defineProps({
    toggleSidebar: {
        type: [Boolean, null],
        required: false,
        default: false,
    },
});

const currentPath = ref(window.location.pathname);

const isActive = (route) => {
    return currentPath.value === route;
};

window.addEventListener("popstate", () => {
    currentPath.value = window.location.pathname;
});

</script>
