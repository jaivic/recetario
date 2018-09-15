struct IngredienteRecetum: Codable {

    var id: Int
    var ingrediente_id: Int
    var receta_id: Int
    var cantidad: Double
    var created_at: String?
    var updated_at: String?
    var unidad: String

    var ingredientes: [Ingrediente]
    var recetas: [Receta]
}
