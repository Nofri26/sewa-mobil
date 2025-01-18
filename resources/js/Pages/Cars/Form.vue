<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const page = usePage();
const form = useForm({
  brand: '',
  model: '',
  plate_number: '',
  daily_rate: '',
  created_by_id: page.props.auth.user.id,
  formattedDailyRate: ''
})

const formatCurrency = () => {
  const rawValue = form.formattedDailyRate.toString().replace(/\D/g, '');
  form.formattedDailyRate = new Intl.NumberFormat('id-ID').format(rawValue);
  form.daily_rate = rawValue;
};

const submit = () => {
  form.post(route('cars.store'))
}
</script>

<template>
  <Head title="Add Car"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Add Car
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <form @submit.prevent="submit">
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <InputLabel for="brand" value="Brand"/>

                  <TextInput
                      id="brand"
                      class="mt-1 block w-full"
                      v-model="form.brand"
                      required
                  />

                  <InputError class="mt-2" :message="form.errors.brand"/>
                </div>
                <div>
                  <InputLabel for="model" value="Model"/>

                  <TextInput
                      id="model"
                      class="mt-1 block w-full"
                      v-model="form.model"
                      required
                  />

                  <InputError class="mt-2" :message="form.errors.model"/>
                </div>
                <div>
                  <InputLabel for="plate_number" value="Plate Number"/>

                  <TextInput
                      id="plate_number"
                      class="mt-1 block w-full"
                      v-model="form.plate_number"
                      required
                  />

                  <InputError class="mt-2" :message="form.errors.plate_number"/>
                </div>
                <div>
                  <InputLabel for="daily_rate" value="Daily Rate"/>

                  <TextInput
                      id="daily_rate"
                      @input="formatCurrency"
                      class="mt-1 block w-full"
                      v-model="form.formattedDailyRate"
                      required
                  />

                  <InputError class="mt-2" :message="form.errors.daily_rate"/>
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
