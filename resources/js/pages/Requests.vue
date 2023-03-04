<script>
import Layout from '../layouts/Layout'

export default {
  layout: Layout,
}
</script>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({ requests: Array })

const handleRequestClicked = (request) => {
  router.visit(`/peek/requests/${request.id}`)
}
</script>

<template>
  <section class="flex-1 overflow-y-scroll bg-white dark:bg-black">
    <div class="w-full">
      <div class="block">
        <div class="inline-block min-w-full border-b border-gray-200 dark:border-zinc-800 align-middle">
          <table class="min-w-full relative">
            <thead class="w-full">
              <tr class="border-b border-gray-200 dark:border-zinc-800">
                <th class="sticky top-0 z-50 border-b border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-900 px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-zinc-100" scope="col">
                  <span class="lg:pl-2">Request</span>
                </th>
                <th class="sticky top-0 border-b border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-900 px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-zinc-100" scope="col">Status</th>
                <th class="sticky top-0 border-b border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-900 px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-zinc-100" scope="col">Duration</th>
                <th class="sticky top-0 border-b border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-900 px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-zinc-100" scope="col">Memory</th>
                <th class="sticky top-0 border-b border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-900 px-6 py-3 text-right text-sm font-semibold text-gray-900 dark:text-zinc-100 md:table-cell" scope="col">Timestamp</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-zinc-800 bg-white dark:bg-black">
              <tr v-for="request in requests" :key="request.id" class="cursor-pointer dark:hover:bg-white/2.5 transition-all ease-in-out" @click="$event => handleRequestClicked(request)">
                <td class="w-full whitespace-nowrap px-6 py-3 text-sm font-medium text-gray-900 dark:text-zinc-100">
                  <div class="flex flex-col space-y-1 lg:pl-2">
                    <p class="uppercase flex-shrink-0 text-2xs font-semibold" aria-hidden="true">
                      <span class="text-green-600" v-if="request.method == 'GET'">{{  request.method }}</span>
                      <span class="text-pink-600" v-if="request.method == 'DELETE'">{{  request.method }}</span>
                      <span class="text-yellow-600" v-if="request.method == 'POST'">{{  request.method }}</span>
                      <span class="text-blue-600" v-if="request.method == 'PUT'">{{  request.method }}</span>
                      <span class="text-purple-600" v-if="request.method == 'PATCH'">{{  request.method }}</span>
                    </p>
                    <div class="truncate">
                      <span>
                        {{ request.short_action }}
                        {{ ' ' }}
                        <span class="font-normal text-gray-500 dark:text-zinc-400">{{ request.path }}</span>
                      </span>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-3 text-sm font-medium text-gray-500 dark:text-zinc-300">
                  <div class="flex items-center space-x-2">
                    <span class="text-sm font-medium leading-6 text-green-600" v-if="(request.status).toString()[0] == '2'">
                      {{ request.status }}
                    </span>
                    <span class="text-sm font-medium leading-6 text-pink-600" v-else>
                      {{ request.status }}
                    </span>
                  </div>
                </td>
                <td class="px-6 py-3 text-sm font-medium text-gray-500 dark:text-zinc-300">
                  <div class="flex items-center space-x-2">
                    <span class="text-sm font-medium leading-6">
                      {{ request.duration }} ms
                    </span>
                  </div>
                </td>
                <td class="px-6 py-3 text-sm font-medium text-gray-500 dark:text-zinc-300">
                  <div class="flex items-center space-x-2">
                    <span class="text-sm font-medium leading-6">
                      {{ request.memory }} mb
                    </span>
                  </div>
                </td>
                <td class="hidden whitespace-nowrap px-6 py-3 text-right text-sm text-gray-500 dark:text-zinc-300 md:table-cell">{{ (new Date(request.created_at)).toLocaleTimeString("en-US", { hour12: false }) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</template>