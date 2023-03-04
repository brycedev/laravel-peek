<script>
import Layout from '../../layouts/Layout'

export default {
  layout: Layout,
}
</script>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ request: Object })

</script>

<template>
  <section class="flex-1 flex flex-col overflow-y-scroll">
    <div class="sticky top-0 flex items-center justify-between border-b border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-900 px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-zinc-100">
      <Link preserve-scroll href="/peek/requests" class="lg:pl-2">&larr; Requests</Link>
    </div>
    <div class="border-b border-gray-200 dark:border-zinc-800">
      <div class="w-full max-w-3xl mx-auto">
        <div class="overflow-hidden rounded-xl w-full">
          <div class="bg-white py-8 dark:bg-black">
            <div class="sm:flex sm:items-center sm:justify-between">
              <div class="sm:flex sm:space-x-5">
                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                  <p class="text-2xl font-semibold text-gray-900 sm:text-2xl dark:text-zinc-100">{{ request.short_action }}</p>
                  <p class="text-md text-gray-600 dark:text-zinc-300 mt-2">
                    <span>
                      <p class="mr-1 inline-flex gap-0.5 justify-center overflow-hidden text-xs font-normal transition rounded-md py-1 px-1 ring-1 ring-inset bg-green-600/10 text-green-500 ring-green-500 uppercase">{{ request.method }}</p>
                    </span>
                    {{ request.path }}
                  </p>
                </div>
              </div>
              <div class="flex items-center space-x-4">
                <div class="mt-5 flex justify-center sm:mt-0">
                  <p class="inline-flex gap-0.5 justify-center overflow-hidden text-md font-light transition rounded-md py-1 px-3 ring-1 ring-inset bg-green-600/10 text-green-500 ring-green-500">{{  request.status }}</p>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex-1">
      <div class="flex flex-col w-full max-w-3xl mx-auto space-y-8">
        <div id="stats">
          <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="overflow-hidden rounded-xl bg-black dark:border dark:border-zinc-800 px-4 py-5 sm:p-6">
              <dt class="truncate text-sm font-medium text-zinc-300">Memory Consumption</dt>
              <dd class="mt-1 text-3xl font-normal tracking-tight text-zinc-100">{{ request.memory }} mb</dd>
            </div>
            <div class="overflow-hidden rounded-xl bg-black dark:border dark:border-zinc-800 px-4 py-5 sm:p-6">
              <dt class="truncate text-sm font-medium text-zinc-300">Duration</dt>
              <dd class="mt-1 text-3xl font-normal tracking-tight text-zinc-100">{{ request.duration }} ms</dd>
            </div>
            <div class="overflow-hidden rounded-xl bg-black dark:border dark:border-zinc-800 px-4 py-5 sm:p-6">
              <dt class="truncate text-sm font-medium text-zinc-300">Success Rate</dt>
              <dd class="mt-1 text-3xl font-normal tracking-tight text-zinc-100">97%</dd>
            </div>
          </dl>
        </div>
        <div id="data" class="grid grid-cols-1 gap-5 sm:grid-cols-2">
          <div class="flex flex-col overflow-hidden rounded-xl bg-zinc-900 dark:bg-black dark:border dark:border-zinc-800 max-h-64">
            <div class="w-full px-4 py-3 border-b border-zinc-700 bg-white/2.5">
              <h3 class="text-xs text-white font-semibold">Headers</h3>
            </div>
            <div class="px-4 py-5 sm:p-6 text-zinc-200 text-sm overflow-scroll">
              {{ request.headers }}
            </div>
          </div>
          <div class="flex flex-col overflow-hidden rounded-xl bg-zinc-900 dark:bg-black dark:border dark:border-zinc-800 max-h-64">
            <div class="w-full px-4 py-3 border-b border-zinc-700 bg-white/2.5">
              <h3 class="text-xs text-white font-semibold">Payload</h3>
            </div>
            <div class="px-4 py-5 sm:p-6 text-zinc-200 text-sm overflow-scroll">
              {{ request.payload }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>