<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import SelectInput from "@/Components/SelectInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { nextTick, ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import VSelect from "vue-select";

const confirmFieldSearch = ref(false);

const props = defineProps({
  transformedUsers: Array | Object,
})

const form = useForm({
  user_id: '',
  plate_number: '',
});

const confirmUserDeletion = () => {
  confirmFieldSearch.value = true;
};

const searchRental = () => {
  form.user_id = form.user_id.value;
  form.get(route('rentals.search'), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => closeModal(),
    onError: (error) => console.log(error),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmFieldSearch.value = false;

  form.clearErrors();
  form.reset();
};

</script>

<template>
  <section class="space-y-6">
    <PrimaryButton @click="confirmUserDeletion">Return a Car</PrimaryButton>

    <Modal :show="confirmFieldSearch" @close="closeModal">
      <div class="p-6">
        <h2
            class="text-lg font-medium text-gray-900"
        >
          Search by plate number
        </h2>

        <div class="grid grid-cols-2 gap-y-2 gap-x-2">
          <div class="mt-6">
            <InputLabel
                for="user_id"
                value="Tenant"
            />

            <v-select
                :options="transformedUsers"
                label="label"
                item-value="value"
                class="mt-1"
                v-model="form.user_id"
                required
            />

            <InputError :message="form.errors.user_id" class="mt-2"/>
          </div>
          <div class="mt-6">
            <InputLabel
                for="plate_number"
                value="Plate Number"
            />

            <TextInput
                id="plate_number"
                v-model="form.plate_number"
                class="mt-1 block w-full"
                @keyup.enter="searchRental"
            />

            <InputError :message="form.errors.plate_number" class="mt-2"/>
          </div>
        </div>

        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="closeModal">
            Cancel
          </SecondaryButton>

          <PrimaryButton
              class="ms-3"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="searchRental"
          >
            Search
          </PrimaryButton>
        </div>
      </div>
    </Modal>
  </section>
</template>

<style scoped>

</style>
