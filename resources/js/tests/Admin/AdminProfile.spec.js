import { render, screen } from '@testing-library/vue';
import { describe, it, vi, expect } from 'vitest';
import ProfileCard from '../../components/ProfileCard.vue';
import { useAdminStore } from '../../store/admin.js'
import { createPinia } from 'pinia';


describe("Admin Profile", () => {

    it("has a admin profile card", () => {


        const store = useAdminStore(createPinia());

        const { setData } = store;

        // Mock data
        const adminData = {
          name: 'John Doe',
          img: 'profile.jpg',
          created_at: '2022-01-01',
        };
      
        // Set data using the setData action
        setData(adminData);

        render(ProfileCard);

        const element = screen.getByText('Admin ( Issue Tracking System )');
        expect(element).toBeInTheDocument();
    })

});