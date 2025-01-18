<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, usePage } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed, ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import VSelect from 'vue-select';

const { cars } = usePage().props;

const filters = ref({
  brand: '',
  model: '',
  is_available: '',
});

const filteredCars = computed(() => {
  return cars.data.filter((car) => {
    const matchesBrand = car.brand.toLowerCase().includes(filters.value.brand.toLowerCase());
    const matchesModel = car.model.toLowerCase().includes(filters.value.model.toLowerCase());
    const matchesAvailability = filters.value.is_available === '' || car.is_available.toString() === filters.value.is_available;

    return matchesBrand && matchesModel && matchesAvailability;
  });
});

const formatCurrency = (value) => {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR'
  }).format(value);
};

const handleBtnCreate = () => {
  router.visit(route('cars.create'))
}
</script>

<template>
  <Head title="Car"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        List Car
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="flex items-center justify-between">
              <div class="flex space-x-4">
                <!-- Filter by Brand -->
                <TextInput
                    v-model="filters.brand"
                    type="text"
                    placeholder="Filter by Brand"
                    class="px-4 py-2 border rounded"
                />

                <!-- Filter by Model -->
                <TextInput
                    v-model="filters.model"
                    type="text"
                    placeholder="Filter by Model"
                    class="px-4 py-2 border rounded"
                />
                <!-- Filter by Availability -->
                <select
                    v-model="filters.is_available"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                  <option value="" disabled selected>Select Availability</option>

                  <option value="1">Available</option>
                  <option value="0">Not Available</option>
                </select>

              </div>
              <PrimaryButton @click="handleBtnCreate">Create</PrimaryButton>
            </div>
            <table class="min-w-full table-auto border-collapse border border-gray-200 mt-4">
              <thead>
              <tr>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">No.</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Brand</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Model</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Plate Number</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Daily Rate</th>
                <th class="px-6 py-3 text-left font-medium text-gray-900 border-b border-gray-200">Created By</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(car, index) in filteredCars" :key="car.id">
                <td class="px-6 py-4 border-b border-gray-200">{{ index + 1 }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ car.brand }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ car.model }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ car.plate_number }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ formatCurrency(car.daily_rate) }}</td>
                <td class="px-6 py-4 border-b border-gray-200">{{ car.created_by }}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
