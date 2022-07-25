<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head,useForm,Link } from '@inertiajs/inertia-vue3';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'


const props=  defineProps({
        todo:Object
});

const form = useForm({
    title:props.todo.title,
    completed_at:props.todo.completed_at,
    completed:props.todo.completed
});


console.log(props)

function destroy(id) {
        if (confirm("Are you sure you want to Delete")) {
            form.delete(route('todos.destroy', id));
        }
    }

const submit = () => {
    form.put(route('todos.update',props.todo.id));

};

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Todo List
            </h2>
        </template>

        <div class="py-12">
          <form name="createForm" @submit.prevent="submit" >
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Todo</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class=" flex items-center">
                    <input v-model="form.title" type="text" name="title" id="title" class="focus:ring-indigo-500 focus:border-indigo-500 block w-1/2 pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Enter todo">
                   <label class="mx-2">Done</label>
                            <select class='mx-5 w-20' v-model='form.completed'>
                                <option value='0' >No</option>
                                <option value='1'>Yes</option>
                            </select>

                   <Datepicker v-model="form.completed_at" placeholder="Enter date"  />

                   <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow ml-2">
                    Update
                    </button>
                </div>
            </div>
            </div>
            </div>
          </form>

        </div>
    </BreezeAuthenticatedLayout>
</template>
