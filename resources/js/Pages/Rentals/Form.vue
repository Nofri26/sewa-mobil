<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import VSelect from "vue-select";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { toRaw, watch } from "vue";

const { cars } = usePage().props;
const page = usePage();

const transformedCars = cars.map(car => ({
  label: `${car.brand} ${car.model}`,
  value: car.id,
}));

const form = useForm({
  start: '',
  end: '',
  cost: '',
  car_id: '',
  created_by_id: page.props.auth.user.id,
})

watch(() => [form.car_id, form.start, form.end], (newValue) => {
  if (newValue[0] && newValue[1] && newValue[2]) {
    const startDate = new Date(newValue[1]);
    const endDate = new Date(newValue[2]);

    const days = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24));

    const filteredCar = toRaw(cars).filter(car => car.id === newValue[0].value);
    if (filteredCar.length > 0) {
      const dailyRate = filteredCar[0].daily_rate;
      form.cost = (dailyRate * days).toString();
    } else {
      console.log('Mobil tidak ditemukan');
    }
  }
});

const submit = () => {
  form.car_id = form.car_id.value;
  console.log(form)
  form.post(route('rentals.store'))
}
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
        <div class=" bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <form @submit.prevent="submit">
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <InputLabel for="start" value="Start"/>

                  <TextInput
                      id="start"
                      type="date"
                      class="mt-1 block w-full"
                      v-model="form.start"
                      required
                  />

                  <InputError class="mt-2" :message="form.errors.start"/>
                </div>
                <div>
                  <InputLabel for="end" value="End"/>

                  <TextInput
                      id="end"
                      type="date"
                      class="mt-1 block w-full"
                      v-model="form.end"
                      required
                  />

                  <InputError class="mt-2" :message="form.errors.end"/>
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

                  <InputError class="mt-2" :message="form.errors.car_id"/>
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

                  <InputError class="mt-2" :message="form.errors.cost"/>
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

<style scoped>

</style>
