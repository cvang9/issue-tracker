import { render, screen } from '@testing-library/vue';
import { describe, expect, it, vi  } from 'vitest';
import SettingsCard from '../../components/SettingsCard.vue';
import userEvent from '@testing-library/user-event';
import { setupServer } from 'msw/node';
import { http } from 'msw';



describe('Create' , () => [

    it('able to create resolver', async () => {

        const server = setupServer(
            http.post('/api/resolvers', async ({ request })=>{
                let requestBody = await request.json();
                return HttpResponse.json({});
            })
        );

        server.listen();
        const user = userEvent.setup();

        render(SettingsCard);
    
        const element = screen.getByLabelText('Full Name');
        const element2 = screen.getByLabelText('Email Address');
        const element3 = screen.getByLabelText('Password');
        const element4 = screen.getByLabelText('Department');
        const element5 = screen.getByText('Resolver Photo');


        await user.type(element, 'Shivang saini');
        await user.type(element2, 'cvang@mail.com' );
        await user.type(element3, 'password' );
        await user.type(element4, 'Security' );

        const button = screen.getByRole('button', { name: 'Create Resolver'} );

        
        expect(element).toBeInTheDocument();
        expect(element2).toBeInTheDocument();
        expect(element3).toBeInTheDocument();
        expect(element4).toBeInTheDocument();
        expect(element5).toBeInTheDocument();
        expect(button).toBeInTheDocument();

    })
])
 