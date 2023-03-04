<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import {
  ArrowTrendingUpIcon,
  Bars3Icon,
  ChevronDoubleRightIcon,
  XMarkIcon,
} from '@heroicons/vue/24/outline'

const navigation = [
  { name: 'Home', href: '/peek', icon: ArrowTrendingUpIcon },
  { name: 'Requests', href: '/peek/requests', icon: ChevronDoubleRightIcon },
]

const mobileMenuOpen = ref(false)
</script>

<template>
  <div class="flex h-screen overflow-hidden">
    <TransitionRoot as="template" :show="mobileMenuOpen">
      <Dialog as="div" class="relative z-40 lg:hidden" @close="mobileMenuOpen = false">
        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
        </TransitionChild>

        <div class="fixed inset-0 z-40 flex">
          <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
            <DialogPanel class="relative flex w-full max-w-xs flex-1 flex-col bg-black focus:outline-none">
              <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                <div class="absolute top-0 right-0 -mr-12 pt-4">
                  <button type="button" class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="mobileMenuOpen = false">
                    <span class="sr-only">Close sidebar</span>
                    <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                  </button>
                </div>
              </TransitionChild>
              <div class="pt-5 pb-4">
                <div class="flex flex-shrink-0 items-center px-4">
                  <p class="pointer-events-none text-sm font-bold tracking-tight text-white uppercase">peek</p>
                </div>
                <nav aria-label="Sidebar" class="mt-5">
                  <div class="space-y-1 px-2">
                    <a v-for="item in navigation" :key="item.name" :href="item.href" class="group flex items-center rounded-md p-2 text-base font-medium text-zinc-200 hover:bg-zinc-800">
                      <component :is="item.icon" class="mr-4 h-6 w-6 text-zinc-200" aria-hidden="true" />
                      {{ item.name }}
                    </a>
                  </div>
                </nav>
              </div>
            </DialogPanel>
          </TransitionChild>
          <div class="w-14 flex-shrink-0" aria-hidden="true">
          </div>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:flex lg:flex-shrink-0 dark:border-r dark:border-r-zinc-800">
      <div class="flex w-20 flex-col">
        <div class="flex min-h-0 flex-1 flex-col overflow-y-auto bg-black">
          <div class="flex-1">
            <div class="flex items-center justify-center bg-black py-8">
              <p class="pointer-events-none text-sm font-bold tracking-tight text-white uppercase">peek</p>
            </div>
            <nav aria-label="Sidebar" class="flex flex-col items-center space-y-3 py-4">
              <Link preserve-scroll href="/peek" class="flex items-center rounded-lg p-4 text-zinc-200 hover:bg-zinc-900" :class="{'bg-zinc-900' : $page.component === 'Dashboard' }">
                <component :is="ArrowTrendingUpIcon" class="h-6 w-6" aria-hidden="true" />
                <span class="sr-only">Dashboard</span>
              </Link>
              <Link preserve-scroll href="/peek/requests" class="flex items-center rounded-lg p-4 text-zinc-200 hover:bg-zinc-900" :class="{'bg-zinc-900' : $page.url.startsWith('/peek/requests') }">
                <component :is="ChevronDoubleRightIcon" class="h-6 w-6" aria-hidden="true" />
                <span class="sr-only">Requests</span>
              </Link>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="flex min-w-0 flex-1 flex-col overflow-hidden">
      <div class="lg:hidden">
        <div class="flex items-center justify-between bg-black py-2 px-4 sm:px-6 lg:px-8">
          <div>
            <p class="pointer-events-none text-sm font-bold tracking-tight text-white uppercase">peek</p>
          </div>
          <div>
            <button type="button" class="-mr-3 inline-flex h-12 w-12 items-center justify-center rounded-md text-white hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="mobileMenuOpen = true">
              <span class="sr-only">Open sidebar</span>
              <Bars3Icon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
        </div>
      </div>
      <main class="flex flex-1 overflow-hidden max-h-screen">
        <slot/>
      </main>
    </div>
  </div>
</template>