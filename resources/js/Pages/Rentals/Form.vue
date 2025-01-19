<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import VSelect from "vue-select";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, toRaw, watch } from "vue";

const { cars, users } = usePage().props;
const page = usePage();
const rawDates = ref([]);
let disabledDatePicker = [];
let filteredCar = [];

const formatDate = (date) => {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, "0");
  const day = String(date.getDate()).padStart(2, "0");

  return `${year}-${month}-${day}`;
};

const transformedCars = cars.data.map((car) => ({
  label: `${car.brand} ${car.model}`,
  value: car.id,
}));

const transformedUsers = users.map((user) => ({
  label: user.name,
  value: user.id,
}));

const form = useForm({
  start: "",
  end: "",
  cost: "",
  car_id: "",
  created_by_id: "",
});

const getRangeDate = (start, end) => {
  const startDate = new Date(start);
  const endDate = new Date(end);
  const dateRange = [];

  while (startDate <= endDate) {
    dateRange.push(new Date(startDate).toISOString().split("T")[0]);
    startDate.setDate(startDate.getDate() + 1);
  }

  return dateRange;
};

watch(
    () => form.car_id,
    (newValue) => {
      filteredCar = toRaw(cars.data).filter(
          (car) => car.id === newValue.value
      );
      if (filteredCar.length) {
        const disabledDates = new Set();
        if (filteredCar[0].rentals) {
          for (const rental of filteredCar[0].rentals) {
            const rangeDates = getRangeDate(rental.start, rental.end);
            for (const date of rangeDates) {
              disabledDates.add(date);
            }
          }
          disabledDatePicker = Array.from(disabledDates);
        }
      }
    }
);

watch(rawDates, (newValue) => {
  if (newValue.length === 2) {
    const startDate = new Date(newValue[0]);
    const endDate = new Date(newValue[1]);
    const days = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24));

    form.start = formatDate(startDate);
    form.end = formatDate(endDate);

    if (filteredCar.length > 0) {
      const dailyRate = filteredCar[0].daily_rate;
      form.cost = (dailyRate * days).toString();
    } else {
      console.log("Mobil tidak ditemukan");
    }

    console.log(`Duration: ${days} days`);
  } else {
    //
  }
});

const submit = () => {
  form.car_id = form.car_id.value;
  form.created_by_id = form.created_by_id.value;
  form.post(route("rentals.store"));
};
</script>

<template>
  <Head title="Add Rental"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Add Rental
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <form @submit.prevent="submit">
              <div class="grid grid-cols-1 gap-4">
                <div>
                  <InputLabel for="created_by_id" value="Tenant"/>
                  <v-select
                      :options="transformedUsers"
                      label="label"
                      item-value="value"
                      class="mt-1"
                      v-model="form.created_by_id"
                      required
                  />
                  <InputError
                      class="mt-2"
                      :message="form.errors.created_by_id"
                  />
                </div>

                <div>
                  <InputLabel for="car_id" value="Car"/>
                  <v-select
                      :options="transformedCars"
                      label="label"
                      item-value="value"
                      class="mt-1"
                      v-model="form.car_id"
                      required
                  />
                  <InputError
                      class="mt-2"
                      :message="form.errors.car_id"
                  />
                </div>
                <div>
                  <InputLabel for="dates" value="Dates"/>
                  <VueDatePicker
                      id="dates"
                      v-model="rawDates"
                      range
                      :multi-calendars="{ solo: true }"
                      :enable-time-picker="false"
                      :disabled-dates="disabledDatePicker"
                      :min-date="new Date()"
                      auto-apply
                  />
                  <InputError
                      class="mt-2"
                      :message="form.errors.start"
                  />
                </div>
                <div>
                  <InputLabel for="cost" value="Cost"/>
                  <TextInput
                      id="cost"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.cost"
                      required
                      readonly
                  />
                  <InputError
                      class="mt-2"
                      :message="form.errors.cost"
                  />
                </div>
              </div>
              <div class="mt-4 flex items-center justify-end">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                  Add
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped></style>
