import { describe, expect, it } from "vitest";
import { render, screen } from "@testing-library/vue";
import ChartOne from '../../components/Charts/ChartOne.vue';
import ChartTwo from '../../components/Charts/ChartTwo.vue';
import DropdownUserVue from "../../components/Header/DropdownUser.vue";
import DarkModeSwitcherVue from "../../components/Header/DarkModeSwitcher.vue";

vi.mock('axios');

describe('Admin dashboard ', () => {

    it("has a User Dropdown", () => {
        render(DropdownUserVue);

        expect(axios.get).toHaveBeenCalledWith('/api/logout', {
            success: 'Successfully logged out'
        });
    })

    it("have Chart one stats", () => {
        render(ChartOne);

        const element = screen.getByText("Tickets Raised");
        const element2 = screen.getByText("Tickets Resolved");

        expect(element).toBeInTheDocument();
        expect(element2).toBeInTheDocument();

    });

    it("have Chart two stats", () => {
        render(ChartTwo);

        const element = screen.getByText("Stats this week");

        expect(element).toBeInTheDocument();

    });



});


