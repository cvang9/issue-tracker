import { describe, expect, it } from "vitest";
import { getByText, screen } from "@testing-library/vue";
import ResolverProfile from "../../components/Resolver/ResolverProfile.vue";
import { render, router } from "../helper";


describe('Resolver Profile ', () => {

    it("displays profile page", async () => {
        router.push('/resolver-profile/1');
        await router.isReady()
        render(ResolverProfile);
    })
});
