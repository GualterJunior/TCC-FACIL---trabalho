<?php

namespace Tests\Feature;

use App\Models\Entrega;
use App\Models\Etapa;
use App\Models\Grupo;
use App\Models\Nota;
use App\Models\Projeto;
use App\Models\Sorteio;
use App\Models\Tema;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScreenSmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_coordinator_screens_render_successfully(): void
    {
        $coordinator = User::where('email', 'coordenador@tccfacil.com')->firstOrFail();

        $routes = [
            route('dashboard'),
            route('projetos.index'),
            route('projetos.create'),
            route('projetos.show', Projeto::firstOrFail()),
            route('projetos.edit', Projeto::firstOrFail()),
            route('turmas.index'),
            route('turmas.create'),
            route('turmas.show', Turma::firstOrFail()),
            route('turmas.edit', Turma::firstOrFail()),
            route('grupos.index'),
            route('grupos.create'),
            route('grupos.show', Grupo::firstOrFail()),
            route('grupos.edit', Grupo::firstOrFail()),
            route('temas.index'),
            route('temas.create'),
            route('temas.show', Tema::firstOrFail()),
            route('temas.edit', Tema::firstOrFail()),
            route('entregas.index'),
            route('entregas.create'),
            route('entregas.show', Entrega::firstOrFail()),
            route('sorteios.index'),
            route('sorteios.create'),
            route('sorteios.show', Sorteio::firstOrFail()),
            route('sorteios.edit', Sorteio::firstOrFail()),
            route('etapas.index'),
            route('etapas.create'),
            route('etapas.show', Etapa::firstOrFail()),
            route('etapas.edit', Etapa::firstOrFail()),
            route('notas.index'),
            route('notas.create'),
            route('notas.show', Nota::firstOrFail()),
            route('notas.edit', Nota::firstOrFail()),
            route('users.index'),
            route('users.create'),
            route('users.show', $coordinator),
            route('users.edit', $coordinator),
            route('validacoes.index'),
            route('suportes.index'),
            route('suportes.create'),
            route('acompanhamento.index'),
            route('sorteios.historico'),
            route('profile.edit'),
        ];

        foreach ($routes as $url) {
            $this->actingAs($coordinator)
                ->get($url)
                ->assertSuccessful();
        }
    }

    public function test_student_screens_render_successfully(): void
    {
        $student = User::where('email', 'aluno1@student.com')->firstOrFail();
        $turma = Turma::firstOrFail();

        $routes = [
            route('dashboard'),
            route('projetos.index'),
            route('projetos.show', Projeto::where('status', 'publicado')->firstOrFail()),
            route('grupos.index'),
            route('grupos.show', Grupo::whereHas('usuarios', fn ($query) => $query->where('users.id', $student->id))->firstOrFail()),
            route('temas.index'),
            route('temas.show', Tema::firstOrFail()),
            route('entregas.index'),
            route('entregas.create'),
            route('entregas.show', Entrega::whereHas('grupo.usuarios', fn ($query) => $query->where('users.id', $student->id))->firstOrFail()),
            route('aluno.meu-tcc.index'),
            route('aluno.notas.index'),
            route('aluno.turmas.index'),
            route('aluno.grupos.create', $turma),
            route('sorteios.historico'),
            route('suportes.index'),
            route('suportes.create'),
            route('profile.edit'),
        ];

        foreach ($routes as $url) {
            $this->actingAs($student)
                ->get($url)
                ->assertSuccessful();
        }
    }
}
