<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Search from "@/Pages/Rentals/Partials/Search.vue"
import { computed } from "vue";

const pages = usePage();
const { rentals, users } = usePage().props;

const transformedUsers = users.map((user) => ({
  label: user.name,
  value: user.id,
}));

const user = computed(() => users.find((user) => user.id === rentals.user.id));

const isAdmin = () => {
  return pages.props.auth?.user?.role === "admin";
};

const handleBtnCreate = () => {
  router.visit(route('rentals.create'));
};
</script>

<template>
  <Head title="Rentals"/>

  <AuthenticatedLayout>
    <template #header>
      <h2
          class="text-xl font-semibold leading-tight text-gray-800"
      >
        List Rental
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="flex items-center justify-between mt-1">
              <p>List Rental</p>
              <div class="flex items-end justify-end gap-4">
                <PrimaryButton v-if="isAdmin()" @click="handleBtnCreate">Create</PrimaryButton>
                <Search :transformed-users="transformedUsers"/>
              </div>
            </div>
            <table class="min-w-full table-auto border-collapse border border-gray-200 mt-4">
              <thead>
              <tr>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">No.</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Tenant</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Car</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Start</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">End</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Status</th>
                <th v-if="isAdmin()" class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Action</th>
              </tr>
              </thead>
              <tr v-for="(rental, index) in rentals.data" :key="rental.id">
                <td class="px-6 py-4 border-b border-gray-200">{{ index + 1 }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ rental.tenant.name }}</td>
                <td class="px-6 py-4 border-b border-gray-200">
                  <div class="flex flex-col">
                    <span class="text-xs">{{ rental.car.brand + ' ' + rental.car.model }}</span>
                    <span class="text-xs">{{ rental.car.plate_number }}</span>
                  </div>
                </td>
                <td class="px-6 py-4 border-b border-gray-200">{{ rental.start }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ rental.end }}</td>
                <td class="px-6 py-4 border-b border-gray-200 capitalize">{{ rental.status }}</td>
                <td v-if="isAdmin()" class="px-6 py-4 border-b border-gray-200">
                  <Dropdown v-if="rental.status === 'rented'" align="left">
                    <template #trigger>
                      <span class="inline-flex rounded-md">
                          <button
                              type="button"
                              class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                          >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                              <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                            </svg>
                          </button>
                      </span>
                    </template>
                    <template #content>
                      <DropdownLink
                          :href="route('rentals.show', rental)"
                      >
                        Return a car
                      </DropdownLink>
                    </template>
                  </Dropdown>
                </td>
              </tr>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
