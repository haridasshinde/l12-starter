import type { User } from '@/types/user';
import Swal from 'sweetalert2';
import { ref } from 'vue';

const emptyUser: User = { id: 0, name: '', email: '', created_at: '', updated_at: '' };

export function useUserSheet() {
    const isSheetOpen = ref(false);
    const selectedUser = ref<User>({ ...emptyUser });

    function openEditSheet(user: User) {
        selectedUser.value = { ...user };
        isSheetOpen.value = true;
    }

    function cancelEdit() {
        isSheetOpen.value = false;
    }

    function saveChanges() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to save the changes?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, save it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('Saving user data', selectedUser.value);
                Swal.fire({
                    icon: 'success',
                    title: 'Saved!',
                    text: 'User data has been saved successfully.',
                    timer: 2000,
                    showConfirmButton: false,
                });
                isSheetOpen.value = false;
                Object.assign(selectedUser, { ...emptyUser });
            }
        });
    }

    return {
        isSheetOpen,
        selectedUser,
        openEditSheet,
        cancelEdit,
        saveChanges,
    };
}
