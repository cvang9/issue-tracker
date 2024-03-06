
import ChartOne from '../../components/Charts/ChartOne.vue';
import ChartTwo from '../../components/Charts/ChartTwo.vue';
import { render, screen } from '@testing-library/vue'
import { describe, expect, it, vi } from 'vitest'
import DataStatsOneVue from '../../components/DataStats/DataStatsOne.vue';


const setup = async () => {
    return render(DataStatsOneVue, {
        props: {
            counts: {
                'tickets': {
                    'pending': 1,
                    'resolved': 1,
                    'rejected': 1,
                    'processed': 1

                },
                'users': {
                    'all_user': 1,
                }
            }
        }
    })
}



describe('Admin dashboard ', () => {

    it("have pending tickets count text", async () => {

        await setup();
        const element = screen.getByText("Pending Tickets");
        expect(element).toBeInTheDocument();

    });

    it("have resolved tickets count text", async () => {

        await setup();
        const element = screen.getByText("Resolved Tickets");
        expect(element).toBeInTheDocument();

    });

    it("have rejected tickets count text", async () => {

        await setup();
        const element = screen.getByText("Resolved Tickets");
        expect(element).toBeInTheDocument();

    });

    it("have all users count text", async () => {

        await setup();
        const element = screen.getByText("Total Users");
        expect(element).toBeInTheDocument();

    });

    it("have all resolvers count text", async () => {

        await setup();
        const element = screen.getByText("Total Resolvers");
        expect(element).toBeInTheDocument();

    });

    it("have all users but not resolvers count text", async () => {

        await setup();
        const element = screen.getByText("Users are not Resolver");
        expect(element).toBeInTheDocument();

    });

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


