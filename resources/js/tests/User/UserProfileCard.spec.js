import { render, screen } from '@testing-library/vue';
import { describe, it, expect } from 'vitest';
import UserProfileCard from '../../components/User/UserProfileCard.vue';
import { useAdminStore } from '../../store/admin.js'
import { createPinia } from 'pinia';

describe("User Profile", () => {

    it("has a User profile card", () => {
        const store = useAdminStore(createPinia());

        const { setData } = store;

        // Mock data
        const userData = {
          name: 'John Doe',
          img: 'profile.jpg',
          created_at: '2022-01-01',
        };
      
        // Set data using the setData action
        setData(userData);

        render(UserProfileCard);

        const element = screen.getByText('User ( Issue Tracking System )');
        expect(element).toBeInTheDocument();
    })
});