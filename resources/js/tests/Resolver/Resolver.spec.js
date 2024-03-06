import { describe, expect, it } from "vitest";
import Resolver from "../../components/Resolver/Resolver.vue";
import { render, router, screen } from "../helper";


describe('Resolver issue page ', () => {

    //displays main page
    it("displays main page", async () => {
        router.push('/resolver/1');
        await router.isReady()
        render(Resolver);
    })

    //displays resolver panel

    it('display panel', async () => {
        router.push('/resolver/1');
        await router.isReady();
        render(Resolver);
        const text = screen.getByText('RESOLVER PANEL');
        expect(text).toBeInTheDocument();
    })

    //displays resolverd tickets and rejected tickets;

    it('display panel', async () => {
        router.push('/resolver/1');
        await router.isReady();
        render(Resolver);
        const text = screen.getByText('Resolved Tickets');
        expect(text).toBeInTheDocument();

        const text2 = screen.getByText('Rejected Tickets');
        expect(text2).toBeInTheDocument();

        const text3 = screen.getByText('Processed Tickets');
        expect(text3).toBeInTheDocument();

        const text4 = screen.getByText('Pending Tickets');
        expect(text4).toBeInTheDocument();
    })

    //displays my profile
    it('display my Profile', async () => {
        router.push('/resolver/1');
        await router.isReady();
        render(Resolver);
        const text = screen.getByText('My Profile');
        expect(text).toBeInTheDocument();
    })

    //displays logout button
    it('display logout button', async () => {
        router.push('/resolver/1');
        await router.isReady();
        render(Resolver);
        const logout = screen.getByText('LogOut');
        expect(logout).toBeInTheDocument();
    })

    //have chat option
    // it('display chat button', async () => {
    //     router.push('/resolver/1');
    //     await router.isReady();
    //     render(Resolver);

    //     const chat = screen.getByText('Chat');
    //     expect(chat).toBeInTheDocument();
    // })
});