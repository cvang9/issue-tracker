import { render, screen } from '@testing-library/vue';
import { describe, it, expect, vi } from 'vitest';
import TableOne from '../../components/Tables/TableOne.vue';
import TableTwo from '../../components/Tables/TableTwo.vue';
import { delay } from 'msw';


describe( "Tables", () => {

    it("has department list", async () => {

        render(TableOne);

        const element = screen.getByText('Department List');
        // await delay(5000);

        expect(element).toBeInTheDocument();

    });


    it("has resolver list", async () => {

        render(TableTwo);

        const element = screen.getByText('Resolvers List');
        expect(element).toBeInTheDocument();
        
    })
})