<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const { rentals } = usePage().props;
console.log(rentals.data[0]);

const handleBtnCreate = () => {
  router.visit(route('rentals.create'));
}
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
        <div
            class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
        >
          <div class="p-6 text-gray-900">
            <div class="flex items-center justify-between">
              <p>List Rental</p>
              <PrimaryButton @click="handleBtnCreate">Create</PrimaryButton>
            </div>
            <table class="min-w-full table-auto border-collapse border border-gray-200 mt-4">
              <thead>
              <tr>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">No.</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Car</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Start</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">End</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Cost</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Status</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Action</th>
              </tr>
              </thead>
              <tr v-for="(rental, index) in rentals.data" :key="rental.id">
                <td class="px-6 py-4 border-b border-gray-200">{{ index + 1 }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ rental.car }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ rental.start }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ rental.end }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ rental.cost }}</td>
                <td class="px-6 py-4 border-b border-gray-200 capitalize">{{ rental.status }}</td>
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
