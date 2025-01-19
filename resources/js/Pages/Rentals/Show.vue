<script setup>
import { Head, router, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { rental } = usePage().props;
console.log(rental.id);

const confirmReturnRental = () => {
  router.put(route('rentals.update', rental.data))
}
</script>

<template>
  <Head title="Rental Return"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Rental Return
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="space-y-6">
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <h3 class="text-lg font-semibold">Car Details</h3>
                  <div class="mt-2 space-y-2">
                    <p><span class="font-medium">Brand : </span> {{ rental.data.car.brand }}</p>
                    <p><span class="font-medium">Model : </span> {{ rental.data.car.model }}</p>
                    <p><span class="font-medium">Plate Number : </span> {{ rental.data.car.plate_number }}</p>
                    <p><span class="font-medium">Daily Rate : </span> Rp {{ (rental.data.car.daily_rate).toLocaleString('id-ID') }}</p>
                  </div>
                </div>
                <div>
                  <h3 class="text-lg font-semibold">Rental Information</h3>
                  <div class="mt-2 space-y-2">
                    <p><span class="font-medium">Start Date : </span> {{ rental.data.start }}</p>
                    <p><span class="font-medium">End Date : </span> {{ rental.data.end }}</p>
                    <p><span class="font-medium">Total Cost : </span> {{ rental.data.formated_cost }}</p>
                    <p><span class="font-medium">Status : </span>
                      <span :class="{
                        'text-green-600': rental.data.status === 'rented',
                        'text-yellow-600': rental.data.status === 'pending',
                        'text-red-600': rental.data.status === 'cancelled'
                      }">
                        {{ rental.data.status.charAt(0).toUpperCase() + rental.data.status.slice(1) }}
                      </span>
                    </p>
                  </div>
                </div>
                <div>
                  <h3 class="text-lg font-semibold">Additional Information</h3>
                  <p class="mt-2"><span class="font-medium">Tenant's name:</span> {{ rental.data.tenant.name }}</p>
                </div>
                <div class="flex justify-end items-end">
                  <div>
                    <PrimaryButton @click="confirmReturnRental">Confirm</PrimaryButton>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
/* You can add any scoped styles here if needed */
</style>
